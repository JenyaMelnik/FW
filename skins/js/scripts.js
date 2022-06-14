function confirmDelete(text) {
    return confirm(text);
}

function testApiRequest() {
    let url = document.getElementById('url').value;
    let action = document.getElementById('action').value;

    let formData = new FormData();
    formData.append('url', url);
    formData.append('action', action);

    fetch(url, {
        body: formData,
        method: "POST",
        cache: "no-cache"
    })
        .then(response => response.text())
        .then((data) => {
            document.getElementById('responseTestApi').value = data;
        });
}
