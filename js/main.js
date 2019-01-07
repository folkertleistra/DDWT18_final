// Clean GET from URL
let url_string = window.location['href'];
let short_url = window.location['href'].split('?')[0];
let url = new URL(url_string);
let id = url.searchParams.get("id");
if (id == null) {
    window.history.pushState(null, null, short_url);
} else {
    let clean_url = short_url.concat(`?id=${id}`);
    window.history.pushState(null, null, clean_url);
}