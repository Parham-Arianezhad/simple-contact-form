// Check if the URL contains the 'success=1' parameter (form submission successful)
if (window.location.search.indexOf('success=1') !== -1) {
    if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('success');
        window.history.replaceState({}, document.title, url.pathname + url.search);
    }
}