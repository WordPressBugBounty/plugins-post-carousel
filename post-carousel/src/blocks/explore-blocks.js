window.addEventListener("load", function () {
    const url = new URL(window.location.href);

    if (!url.searchParams.has("spblock_inserter")) return;

    function tryClick() {
        const btn = document.querySelector(".editor-document-tools__inserter-toggle");
        if (btn) {
            btn.click();
            url.searchParams.delete("spblock_inserter");
            history.replaceState(null, "", url.toString());
            return true;
        }
        return false;
    }

    // Try every 100ms for up to 2 seconds
    let attempts = 0;
    const interval = setInterval(() => {
        attempts++;
        if (tryClick() || attempts > 20) {
            clearInterval(interval);
        }
    }, 100);
});
