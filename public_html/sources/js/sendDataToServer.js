/**
 * @param {string} service - lobnya / sevastopol / udaltsova / nauchnyy
 * @param {string} phone - Телефон
 * @param {string} type - forma / red_phone
 * @param {string} name - Имя (сработает только в type === forma)
 */
function sendDataToServer(service, phone, type, name= "-") {
    const currentUrl = window.location.href;
    const data = {
        url: currentUrl,
        service: service,
        phone: phone,
        type: type,
        name: name
    };
    fetch('https://fos.qrenta.ru/v1/fos', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    }).then(result => {
        console.log('Success:', result);
    }).catch(error => {
        console.error('Error:', error);
    });
}
