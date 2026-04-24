import gulp from "gulp";
import * as dartSass from "sass";
import gulpSass from "gulp-sass";
import cleanCSS from "gulp-clean-css";
import rename from "gulp-rename";
import fs from "fs";

const sass = gulpSass(dartSass);

// Compile & Minify SCSS for all blocks
export function compileStyles() {
  const blocks = fs
    .readdirSync("src/blocks")
    .filter((file) => fs.lstatSync(`src/blocks/${file}`).isDirectory());

  const tasks = blocks.map((block) => {
    const srcPath = `src/blocks/${block}/style.scss`;
    const destPath = `blocks/includes/${block}`;

    if (fs.existsSync(srcPath)) {
      return gulp
        .src(srcPath)
        .pipe(sass().on("error", sass.logError)) // normal compile
        .pipe(cleanCSS({ compatibility: "ie11" })) // minification
        .pipe(rename("style.css"))
        .pipe(gulp.dest(destPath));
    }
    return null;
  });

  return Promise.all(
    tasks
      .filter(Boolean)
      .map((stream) => new Promise((resolve) => stream.on("end", resolve)))
  );
}

// Watcher task for development
export function watchFiles() {
  gulp.watch("src/blocks/*/style.scss", compileStyles);
}

// Default task
export default gulp.series(compileStyles);