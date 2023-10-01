let Utils = {
    regex: {
        validUrl: /^(https?|http):\/\/([A-Z0-9-]+\.)+[A-Z]{2,6}\/?/i,
        isHTML: /<\s?[^\>]*\/?\s?>/i,
        isOnlyLettersNumbersSpaces: /^[a-zA-Z0-9 ]*$/,
        isValidTextarea: /^[A-Za-záéíóúÁÉÍÓÚ0-9,.\s\n]+$/,
    },
    isValidURL: function(url){
        return this.regex.validUrl.test(url);
    },
    isHTML: function(content){
        return this.regex.isHTML.test(content);
    },
    isOnlyLettersNumbersSpaces: function(content){
        return this.regex.isOnlyLettersNumbersSpaces.test(content);
    },
    isValidTextarea: function(content){
        return this.regex.isValidTextarea.test(content);
    },
    makeRequest: async function(url, callback, method="GET", body=null){
        let data = await fetch(url, {method:method, body:JSON.stringify(body)});
        callback(await data.json());
    },
    GET: async function(url, callback){
        let data = await fetch(url);
        callback(await data.json());
    },
    POST:   function(url, callback, body=null){this.makeRequest(url, callback, "POST", body)},
    PUT:    function(url, callback, body=null){this.makeRequest(url, callback, "PUT", body)},
    DELETE: function(url, callback, body=null){this.makeRequest(url, callback, "DELETE", body)},
    
}

document.addEventListener("DOMContentLoaded", () => {
    //Capture the navigation bar and set a click listener
    let navbar = document.querySelector("nav");
    let icon = document.querySelector("#icon");
    icon.addEventListener("click", () => navbar.className = navbar.className === "" ? "show" : "");
});