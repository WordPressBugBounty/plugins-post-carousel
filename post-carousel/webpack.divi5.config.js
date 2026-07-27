const path = require('path');
const fs = require('fs');

/**
 * Standalone webpack config for the Divi 5 module bundle.
 *
 * This build is intentionally NOT run through @wordpress/scripts: it needs its
 * own `externals` (below) that map `@wordpress/hooks` to Divi's own hooks
 * instance at `window.vendor.wp.hooks`. wp-scripts' dependency extraction would
 * instead map it to `window.wp.hooks` — the wrong instance — which breaks the
 * custom module icon registration. So we run plain webpack (already installed at
 * the project root via @wordpress/scripts) against this dedicated config.
 */

// Copies module.json into the build output folder after each build. The PHP
// side (ModuleRegistration::register_module) reads module.json from
// blocks/build/divi5/ at runtime, and that folder ships in the production zip
// while src/ does not. Running on afterEmit guarantees the output folder
// exists (webpack just created it), so this also works on a first-time build.
const copyModuleJson = {
	apply: (compiler) => {
		compiler.hooks.afterEmit.tap('CopyModuleJson', () => {
			const src = path.resolve(__dirname, 'src/divi-5/module.json');
			const destDir = path.resolve(__dirname, 'blocks/build/divi5');
			fs.mkdirSync(destDir, { recursive: true });
			fs.copyFileSync(src, path.join(destDir, 'module.json'));
		});
	},
};

module.exports = {
	// Resolve relative paths against this config's directory, not the CWD.
	context: __dirname,

	// Webpack starts bundling assets from the following file.
	entry: {
		bundle: './src/divi-5/index.jsx',
	},

	// Divi Visual Builder uses scripts already enqueued by WordPress and available
	// in global scope so those scripts don't need to be included in the bundle.
	// For webpack to recognize those files, the global variable needs to be
	// registered as externals. This allows global variables listed below to be
	// imported into the module.
	externals: {
		// Third party dependencies.
		react: 'React',
		// Divi 5 exposes WordPress packages under window.vendor.*, and its icon
		// library reads the icon map through that same @wordpress/hooks instance.
		// Mapping to window.vendor.wp.hooks ensures our addFilter is picked up.
		'@wordpress/hooks': ['vendor', 'wp', 'hooks'],
	},

	// This option determines how different types of modules within the project will be treated.
	module: {
		// This option sets up loaders for webpack configuration.
		rules: [
			// Handle `.jsx` files.
			{
				test: /\.jsx?$/,
				exclude: /node_modules/,
				use: [
					// Transpiles JavaScript files using Babel.
					{
						loader: 'babel-loader',
						options: {
							// Isolate from the root .babelrc so this build's babel
							// config is fully self-contained and deterministic.
							babelrc: false,
							configFile: false,
							compact: false,
							presets: [
								// Preset that adds configuration for handling latest JavaScript syntax.
								[
									'@babel/preset-env',
									{
										modules: false,
										targets: '> 5%',
									},
								],

								// Preset that adds configuration for handling React & JSX.
								'@babel/preset-react',
							],
							plugins: [
								'@babel/plugin-syntax-optional-chaining',
								'@babel/plugin-syntax-nullish-coalescing-operator',
							],
							cacheDirectory: false,
						},
					},
				],
			},
		],
	},

	// Determine how modules are resolved.
	resolve: {
		// Allows extension to be left off when importing.
		extensions: ['.js', '.jsx'],
	},

	// Determine where the created bundles will be outputted.
	output: {
		filename: 'spsp-divi5.js',
		path: path.resolve(__dirname, 'blocks/build/divi5'),
	},

	// Copy module.json into the output folder so PHP can read it at runtime.
	plugins: [copyModuleJson],
};
