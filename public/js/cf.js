/*<![CDATA[*/

function parseUrl(input) {
    const result = {};
    const pairs = input.split('|').map(pair => pair.trim());
    
    pairs.forEach(pair => {
        const [key, value] = pair.split(':').map(str => str.trim());
        result[key] = value.split(',').map(str => str.trim());
    });

    return result;
}
function parseStrings(obj) {
    const pairs = [];

    for (const key in obj) {
        if (obj.hasOwnProperty(key)) {
            const values = obj[key].join(', ');
            pairs.push(`${key}: ${values}`);
        }
    }

    return pairs.join(' | ');
}


document.addEventListener('DOMContentLoaded', () => {
    /* load setting */
    if (dataConfig) {
        for (const [key, val] of Object.entries(dataConfig)) {
            Object.keys(val).forEach(key_ => {
                try {
                    let elmt = document.querySelector(`#${key} [name=${key_}]`);

                    if (elmt && elmt.getAttribute('type') == 'checkbox') {
                        if (val[key_] == true) {
                            elmt.checked = true;
                        }
                    } else if (elmt) {
                        if (elmt.getAttribute("data-parse-url")) {
                            let str = parseStrings(val[key_]);
                            elmt.value = str;
                        } else if (elmt.getAttribute('input-data-type') === 'array') {
                            elmt.value = val[key_].join(", ");
                        } else if (elmt.getAttribute('data-obj') == 'true') {
                            elmt.value = JSON.stringify(val[key_]);
                        } else {
                            elmt.value = val[key_];
                        }
                    }
                } catch (error) {
                    alert("Error")
                    return;
                }
            });
        }
    }
    console.log(dataConfig)
    /* hanlde sumit */
    const cfForm = document.querySelector("#cfForm");
    cfForm.addEventListener("submit", event => {
        event.preventDefault();
        const inpVal = {};

        function processElements(selector, section) {
            if (!inpVal[section]) {
                inpVal[section] = {};
            }
        
            cfForm.querySelectorAll(selector).forEach(e => {
                try {
                    if (e.value) {
                        const name = e.getAttribute('name');
                        if (e.getAttribute("type") == "checkbox") {
                            inpVal[section][name] = e.checked;
                        } else if (e.getAttribute("data-parse-url")) {
                            let obj = parseUrl(e.value);
                            inpVal[section][name] = obj;
                        } else if (e.getAttribute('input-data-type') == 'array') {
                            inpVal[section][name] = e.value.split(", ");
                        } else if (e.getAttribute('data-obj') == 'true') {
                            inpVal[section][name] = JSON.parse(e.value);
                        } else {
                            inpVal[section][name] = e.value;
                        }
                }
                } catch (error) {
                    console.log(error)
                    alert("Error processing element");
                    return;
                }
            });
        }
        
        processElements('#direct-ad input, #direct-ad select, #direct-ad textarea', 'direct-ad');
        processElements('#ad-1 input, #ad-1 select, #ad-1 textarea', 'ad-1');
        processElements('#ad-2 input, #ad-2 select, #ad-2 textarea', 'ad-2');
        processElements('#banner-ad input, #banner-ad select, #banner-ad textarea', 'banner-ad');
        processElements('#next-step input, #next-step select, #next-step textarea', 'next-step');
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alert('Dữ liệu được cập nhật thành công');
            } else if (this.readyState == 4 && this.status == 404) {
                alert('Data not found');
            }
        };
        xhttp.open("PUT", "./", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector('meta[name="csrf-token"]').content);
        xhttp.send("data=" + JSON.stringify(inpVal));
    
    });
});

