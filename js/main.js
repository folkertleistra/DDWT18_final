// Clean GET from URL
let clean_url = window.location['href'].split('?')[0];
window.history.pushState(null, null, clean_url);