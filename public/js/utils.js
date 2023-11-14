//*********************** */
//* send request to server(ajax)
// * @param {*} route route to send request
// * @param {*} data data to send
// * @param {*} method method to use
// * @returns respnse from server
//


function sendRequest(route, data, method = "POST") {
    var csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const headers = {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": csrfToken,
    };

    // Only set 'Content-Type' for methods other than GET/HEAD
    if (method !== "GET" && method !== "HEAD") {
        headers["Content-Type"] = "application/json";
    }

    const fetchOptions = {
        method: method,
        headers: headers,
    };

    // Only add body for methods other than GET/HEAD
    if (method !== "GET" && method !== "HEAD") {
        fetchOptions.body = JSON.stringify(data);
    }

    return fetch(route, fetchOptions).then((response) => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
    });
}


function sendRequestOLD(route, data, method = "POST") {
    var csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    return fetch(route, {
        method: method,
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify(data),
    }).then((response) => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
    });
}
