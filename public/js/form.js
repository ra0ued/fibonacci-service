let http = {};

http.getJson = async function (url = '', headers) {
    let p = {
            method: 'GET',
            headers: headers ?? {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }
    ;

    const response = await fetch(url, p);

    return await response.json();
};

function calculate() {
    let from = document.getElementById('from').value;
    let to = document.getElementById('to').value;
    let url = '/api/v1/fibonacci?from=' + from + '&to=' + to;

    http.getJson(url).then(function (json) {
        if (json.hasOwnProperty('success') && json.hasOwnProperty('result') && json.result != null) {
            let resultHolder = document.getElementById('result');
            resultHolder.innerHTML = json.result;
            resultHolder.removeAttribute('hidden');
        }

        if (json.hasOwnProperty('error')) {
            let resultHolder = document.getElementById('result');
            resultHolder.innerHTML = json.error.description;
            resultHolder.setAttribute('class', 'text-danger p-3');
            resultHolder.removeAttribute('hidden');
        }
    });
}