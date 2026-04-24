const AboutUs = () => {
    return (
        <section id="about-us-tab" className="spspc__help about-page">
            <div className="spspc-container">
                <div className="spspc-about-box">
                    <div className="spspc-about-info">
                        <h3>The Most Powerful Post Grid & Page Builder Blocks for Blogs, News & Any Site</h3>
                        <p><b>Smart Post</b> is an advanced Gutenberg blocks library designed to help you showcase your content beautifully—without writing a single line of code. </p>
                        <p>Create stunning layouts like post grids, lists, sliders, carousels, timelines, and more using <strong>60+ ready-to-use blocks and modules</strong>. Easily display posts, pages, custom post types, taxonomies, and custom fields exactly the way you want.</p>
                        <p>Perfect for <strong>blogs, news sites, magazines, portfolios, and niche websites</strong>—Smart Post gives you full control to build engaging, high-performing layouts in just a few clicks.</p>
                        <div className="spspc-about-btn">
                            <a target="_blank" href="https://wpsmartpost.com/" className='spspc-medium-btn'>Explore Smart Post</a>
                            <a target="_blank" href="https://shapedplugin.com/about-us/" className='spspc-medium-btn spspc-arrow-btn'>More About Us <i className="spspc-icon-button-arrow-icon"></i></a>
                        </div>
                    </div>
                    <div className="spspc-about-img">
                        <img src={`${sp_pcp_block_settings?.pluginUrl}admin/assets/img/shapedplugin-team.jpg`} alt="ShapedPlugin Team" />
                        <span>The Creative Minds Behind the Smart Post Plugin</span>
                    </div>
                </div>
            </div>
        </section>
    )
}

export default AboutUs;