class STU {
    constructor(config = {}) {
        this.bases = {
            'select': false,
            'type': 'create',
            '': '',
        };

        this.select = config.select ? config.select : false;
        this.type = config.type ? config.type : 'create';
        if (this.type == 'edit') {
            const data = config.data;
            this.inp = (data && data.inp) ? data.inp : false;
            this.btn = (data && data.outp) ? data.outp : false;
            this.alias = (data && data.alias) ? data.alias : false;
        }

        this.toastr = new Notyf({
            duration: 4500,
            position: {
                x: "center",
                y: "top"
            },
            dismissible: true
        });
        //
        this.loadSTU();
        this.handleClick();
        this.validate();
        this.handleSubmit();
        this.reset();
        this.copy();
        if (this.type != 'edit') {
            this.setOld();
        }
        this.old();

    }

    loadSTU() {
        
        let conStrs = arr => {
            let res = "";
            arr.forEach(str => {
                res += str;
            });
            return res;
        }

        let renderInputs = (btnId, e) => {
            let result = "";

            if (fbSTU[btnId].dt) {
                let inputSection = "";
                fbSTU[btnId].dt.forEach(item => {
                    inputSection += item.fi ? ((fields, name, id, isFeedback, color) => {
                        let inputElements = "";
                        fields.forEach(field => {
                            let attributes = "";
                            if (field.attr) {
                                field.attr.forEach(attr => {
                                    attributes += ` ${Object.keys(attr)[0]}="${Object.values(attr)[0]}"`;
                                });
                            }
                            inputElements += `<label ${isFeedback ? 'data-fb=true' : ''} data-group="${id}" class="${field.a ? 'a' : ''}" style="--clr:${color}">
                                                ${field.t == 'select'
                                                ? `<div class="stu_fi a"><select id="i_${field.i}" class="stu_fi ${field.ndf ? 'ndf' : ''} ${field.a ? 'd' : ''}"
                                                    name="${field.i}"
                                                    ${field.r ? 'data-req="true"' : ''}
                                                    
                                                    ${attributes} ${fbSTU[btnId].df || field.df ? 'data-df="true"' : ''}
                                                    data-in="${btnId}"><option class="hidden" value=" ">${field.ph ? field.ph : `Enter ${name}...`}</option>
                                                        ${field.opts.map(function(option) {
                                                            return '<option value="' + option[0] + '">' + option[1] + '</option>';
                                                        }).join('') }
                                                    </select></div>`
                                                : `<input class="stu_fi ${field.ndf ? 'ndf' : ''} ${field.a ? 'd' : ''}" id="i_${field.i}" type="${field.t}" name="${field.i}"
                                                placeholder="${field.ro && this.type == 'api' ? `Thiết lập khi sử dụng API` : field.ph ? field.ph : `Enter ${name}...`}"
                                                ${field.a && field.r && this.type != 'api' ? 'required' : ''}
                                                ${field.r && this.type != 'api' ? 'data-req="true"' : field.ro && this.type == 'api' ? 'readonly' : ''}

                                                ${attributes} ${fbSTU[btnId].df || field.df ? 'data-df="true"' : ''} data-in="${btnId}" ${field.img ? 'data-img="true"' : ''} ${field.l ? 'data-link="true"' : ''}/>\n`}
                                                <span>${icSTU[field.ic] ? icSTU[field.ic] : 'icon'}</span>
                                                <i>${icSTU.df}</i>\n
                                            </label>${field.img ? '<div class="stu-image"><div class="loading-overlay"></div><img src=""></div>' : ''}\n`;
                        });
        
                        return fields.length > 1 ? `<div data-cgroup="${id}" class="grp ${fields[1].a ? 'a' : ''}">${inputElements}</div>` : inputElements;
                    })(item.fi, item.name, item.id, fbSTU[btnId].fb, item.clr ? item.clr : e) : '';
                });
        
                result += inputSection;
            }
        
            return result;
        }

        let u = []
        let p = []
        let f = []

        let renderButtons = t => {
            var e, i, s, n, a, r;
            fbSTU[t] && (e = t, i = fbSTU[t].tx, s = fbSTU[t].clr, u.push('<button type="button" class="stu_b_ftr ' + (fbSTU[t].ics ? "ics" : "") + '" data-id="' + t + '" style="--clr:' + s + '">\n  <span>' + i + "</span> " + icSTU.bpm + "\n</button>"), n = t, a = fbSTU[t].tx, r = fbSTU[t].clr, p.push('<div class="stu_ftr" data-ftr="' + t + '" data-text="' + a + '">\n  ' + ((t, e) => {
                let i = "";
                if (fbSTU[t].dt) {
                    let s = "";
                    fbSTU[t].dt.forEach(i => {
                        s += '<button type="button" class="btn_iftr ' + (i.fi[0].a ? "a d" : "") + " " + (fbSTU[t].ics ? "ics" : "") + '" data-id="' + i.id + '" style="--clr:' + (i.clr ? i.clr : e) + '">\n        <span>' + i.name + "</span> " + icSTU.bpm + "\n      </button>"
                    }), i = '<div class="stu_iftr">' + s + "</div>"
                }
                return i
            })(t, r) + "\n  </div>"), f.push(renderInputs(t, fbSTU[t].clr)))
            };
        Object.keys(fbSTU).forEach(t => {
            renderButtons(t)
        });
        let options = '';
        Object.keys(STULv).forEach(key => {
            options += `<option value="${key}">-- ${STULv[key]}</option>`
        });

        document.querySelector(this.select).innerHTML = `
            <form class="fgSTU" id="fgSTU">
                    ${this.type == 'api' ? `
                <div class="stu_ftr_inp">
                    <label data-group="g_ttl" class="a">
                        <input class="stu_fi d" id="i_ttl" type="text" name="napi" placeholder="Nhập tên API.. (tuỳ chọn)" data-in="oth" minlength="4" maxlength="50"/>
                        <span>${icSTU.ttl}</span> <i>${icSTU.df}</i>
                    </label>
                </div><hr></hr>` : ''}
                <div class="stu_ftr_inp">
                    <label data-group="g_ttl" class="a">
                        <input class="stu_fi d" id="i_ttl" type="text" name="ttl" placeholder="${STUtxt.ttl_ph}" data-in="oth" minlength="4" maxlength="50"/>
                        <span>${icSTU.ttl}</span> <i>${icSTU.df}</i>
                    </label>
                    <label data-group="g_ttl" class="a">
                    <input class="stu_fi d" id="i_sttl" type="text" name="sttl" placeholder="${STUtxt.sttl_ph}" data-in="oth" minlength="4" maxlength="400"/>
                    <span>${icSTU.sttl}</span> <i>${icSTU.df}</i>
                    </label>
                </div>
                <div class="stu_l_btn">${conStrs(u)}</div>
                <div class="stu_ftr_cnt" id="stuFtr">${conStrs(p)}</div>
                <div class="stu_ftr_inp" id="stuInp">${conStrs(f)}</div>
                <div class="stu_lv a">
                    <label for="i_level">${STUtxt.lv_lb}</label>
                    <select id="i_level" class="stu_fi d ok" name="level" data-fill="true" data-in="oth">
                        ${options}
                    </select>
                </div>

                <div class="stu_ftr_btn">
                        <button type="submit">${this.type == 'edit' ? 'Cập nhật' : STUtxt.create_link}</button>
                    <button id="rsSTU" type="button">${STUtxt.reset}</button>
                </div>

                <div class="stu_rst">
                    <div>
                    <input id="i_rst" type="url" name="rst" readonly/>
                    <span>${icSTU.rst}</span> <i>Copy</i>
                    </div>
                </div>
            </form>
        `;    
    }
    old() {
        const selector = document.querySelector(this.select)

        const oldI = (this.type === 'edit') ? (this.inp || null) : (this.type === 'api') ? (JSON.parse(localStorage.getItem("input_STU_TK")) || null) : (JSON.parse(localStorage.getItem("input_STU")) || null);
        const oldB = (this.type === 'edit') ? (this.btn || null) : (this.type === 'api') ? (JSON.parse(localStorage.getItem("btn_STU_TK")) || null) : (JSON.parse(localStorage.getItem("btn_STU")) || null);
        if (oldI) {
            for (const key in oldI) {
                const s = selector.querySelector("[name=" + key + "]");
                if (s) {
                    if ("date" == s.type) {
                        if (Date.parse(new Date(oldI[key])) >= Date.parse(new Date().toISOString().split("T")[0])) {
                            s.value = oldI[key];
                            s.classList.add("ok");
                        }
                    } else {
                        s.value = oldI[key];
                        s.classList.add("ok");
                    }

                    if (s.classList.contains("d")) {
                        s.dataset.fill = true;
                    }

                    if (s.dataset.img) {
                        const n = s.parentNode.nextSibling;
                        /*n.classList.add("a"), */ n.querySelector("img").src = oldI[key];
                    }
                }
            }
        }

        if (oldB) {
            for (const o in oldB) {
                const l = selector.querySelector("[data-id=" + o + "]");
                if (l && !l.classList.contains("a")) {
                    l.click();
                }
            }
        }
    }

    handleClick() {
        const toastr = this.toastr;
        const selector = document.querySelector(this.select)

        selector.querySelectorAll(".stu_b_ftr").forEach(button => {
            button.addEventListener("click", () => {
                let id = button.dataset.id;
                if (button.classList.contains("a")) {
                    selector.querySelector(".stu_ftr[data-ftr=" + id + "]").classList.remove("a");
                    button.classList.remove("a");
                } else {
                    selector.querySelector("#stuFtr").dataset.ftr = id;
                    selector.querySelectorAll(".stu_b_ftr").forEach(b => {
                        b.classList.remove("a");
                    });
                    selector.querySelectorAll(".stu_ftr").forEach(element => {
                        element.dataset.ftr == id ? element.classList.add("a") : element.classList.remove("a");
                    });
                    button.classList.add("a");
                }
            });
        });
        selector.querySelectorAll(".btn_iftr:not(.d)").forEach(button => {
            button.addEventListener("click", () => {

                button.classList.toggle("a");
        
                let groupId = button.dataset.id;
        
                if (groupId) {
                    selector.querySelectorAll("[data-group=" + groupId + "]").forEach(element => {
                        if (element.classList.contains("a")) {

                            let requiredInput = element.querySelector("input[data-req]");
                            if (requiredInput !== null) {
                                requiredInput.required = false;
                            }
        
                            let inputElement = element.querySelector("label>*");
                            if (inputElement && inputElement.value && inputElement.classList.contains("er")) {
                                inputElement.value = "";
                                inputElement.classList.remove("er");
                            }
        
                            delete inputElement.dataset.fill;
                        } else {

                            let inputElement = element.querySelector("label>*");
                            if (inputElement) {
                                inputElement.dataset.fill = true;
                            } 
        
                            let requiredInput = element.querySelector("input[data-req]");
                            if (requiredInput !== null) {
                                requiredInput.required = true;
                            }
                        }
        
                        element.classList.toggle("a");
                    });
        
                    selector.querySelectorAll("[data-cgroup=" + groupId + "]").forEach(element => {
                        element.classList.toggle("a");
                    });
                }
            });
        }); 

        if (selector.querySelector(".stu_fi[type=file]")) {
            selector.querySelector(".stu_fi[type=file]").addEventListener("change", t => {
                let e = t.target,
                    n = e.parentNode.nextSibling.nextSibling.querySelector(".stu_fi"),
                    a = e.files[0];
                if (!e.value) return;
                if (!a.type.includes("image")) return void toastr.error("Select an image file..");
                if (a.size > 2097152) return void toastr.error("Image size exceeds 2MB. Please choose a smaller image..");
                let r = toastr.success('<div class="xldg"><span>Uploading, please wait..</span><svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M283.2 65.92C267.6 63.69 256 50.32 256 34.52c0-19.38 17.19-34.69 36.38-31.95C416.4 20.29 512 127.2 512 256c0 33.38-6.544 65.26-18.27 94.49c-7.162 17.86-28.85 24.87-45.56 15.32c-13.74-7.854-19.62-24.53-13.75-39.23C443.2 304.7 448 280.9 448 256C448 159.4 376.3 79.18 283.2 65.92z"/><path class="fa-secondary" d="M493.7 350.5C456 444.9 363.7 512 256 512c-141.2 0-256-114.8-256-256s114.8-256 256-256c11.91 0 23.54 1.104 35.03 2.686C272.4 .8672 256 15.62 256 34.52c0 15.8 11.58 29.17 27.23 31.4c.9648 .1367 1.844 .5116 2.805 .6639C276.2 65.04 266.2 64 256 64C150.1 64 64 150.1 64 256s86.13 192 192 192c81.67 0 151.4-51.34 179.1-123.4c-.248 .6406-.4215 1.317-.6754 1.954c-5.869 14.7 .0045 31.38 13.75 39.23C464.8 375.3 486.5 368.2 493.7 350.5z"/></svg></div>'),
                    o = new FormData;
                o.append("key", cfSTU.imgbb.key), o.append("expiration", cfSTU.imgbb.exp), o.append("name", "stu-" + +new Date), o.append("image", a);
                let c = new XMLHttpRequest;
                c.open("POST", "https://api.imgbb.com/1/upload", !0), c.onload = () => {
                    let t = JSON.parse(c.responseText);
                    if (200 === c.status) {
                        let e = t.data.display_url;
                        s.dismiss(r), n.value = e, n.dataset.fill = !0, n.classList.add("ok"), n.classList.remove("er");
                        let a = n.parentNode.nextSibling;
                        a.classList.add("a"), a.querySelector("img").src = e;
                    } else s.dismiss(r), i.error(t.error.message)
                }, c.onerror = () => {
                    s.dismiss(r), toastr.error("Upload failed...")
                }, c.send(o)
            })
        }
        if (selector.querySelector(".stu_fi[data-img]")) {
            selector.querySelector(".stu_fi[data-img]").addEventListener("change", t => {
                let e = t.target,
                    s = e.parentNode.nextSibling.querySelector("img");
                if (!e.value) return e.classList.remove("ok"), e.classList.remove("er"), delete e.dataset.fill, s.parentNode.classList.remove("a"), void lsHandlerInp("r", e.name);
                if (e.dataset.fill = !0, !e.value.includes("//")) return e.classList.add("er"), e.classList.remove("ok"), void s.parentNode.classList.remove("a");

                let n = "";
                const youtubeRegex = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
                const match = e.value.match(youtubeRegex);

                if (match) {
                    const videoId = match[1];
                    n = `https://img.youtube.com/vi_webp/${videoId}/sddefault.webp`;
                }

                s.parentNode.classList.add("a"), n ? (s.src = n, e.value = n) : s.src = e.value;
                let a = toastr.success({
                    message: '<div class="xldg"><span>Đang tải hình ảnh, vui lòng đợi..</span> ' + icSTU.load + "</div>"
                    , duration: 0
                    , dismissible: false
                    , icon: false
                });

                setTimeout(() => {
                    toastr.dismiss(a);

                    if (s.offsetHeight < 100) {
                        toastr.error("Liên kết ảnh không hợp lệ.");
                        e.classList.add("er");
                        e.classList.remove("ok");
                        s.parentNode.classList.remove("a");
                    } else {
                        e.classList.add("ok");
                        e.classList.remove("er");
                        s.parentNode.classList.remove("a");
                        toastr.success('Hình ảnh hợp lệ...');
                    }
                }, 1500)

            });
        }
    }

    handleSubmit() {
        const toastr = this.toastr;
        const type = this.type;
        const selector = document.querySelector(this.select);

        selector.querySelector("#fgSTU").addEventListener("submit", event => {
            event.preventDefault();
            const elmError = selector.querySelector("label.a>.stu_fi.er");
            const totalSteps = selector.querySelectorAll("label.a>.stu_fi.ok");
            if (elmError) {
                elmError.focus();
            } else if (totalSteps.length < 3 && selector.querySelector('#i_level.stu_fi').value == 3) {
                toastr.error('Để sử dụng lv3 bạn cần tạo ít nhất 3 bước')
            } else {
                let n = event.target.querySelector("[type=submit]");
                if (!n.classList.contains("a")) {
                    n.classList.add("a");
                    let ecSTU = t => btoa(encodeURIComponent(t)),
                        notif = toastr.success({
                            message: 
                            `<div class="xldg">
                                ${icSTU.gen}<span>Generating, please wait..</span>
                            </div>`
                            , duration: 0
                            , dismissible: false
                            , icon: false
                        }); 
                    selector.querySelector(".stu_rst").classList.remove("a");
                    const objParams = {};
                    const selectorsArr = [
                                        [":not([data-in='file'], [data-in='oth'])", 'btn'],
                                        ["[data-in='oth']", 'oth'],
                                        ["[data-in='file']", 'lnk']
                                    ];

                    selectorsArr.forEach(([selectAr, category]) => {
                        selector.querySelectorAll(`.stu_fi[data-fill]${selectAr}`).forEach(input => {
                            if (input.parentNode.classList.contains("a")) {
                                objParams[category] = objParams[category] || {};
                                objParams[category][input.name] = btoa(encodeURIComponent((input.value)));
                            }
                        });
                    })

                    const methodXhr = type == 'create' || type == 'api' ? 'POST' : 'PUT';
                    const urlXhr = type == 'create' ? '/stu' : type == 'api' ? '/api' : '/stu/'+this.alias;
                    const CR_TOKEN = document.head.querySelector("[name~=csrf-token]").content;

                    this.request(methodXhr, urlXhr, CR_TOKEN, objParams)
                        .then((res) => {
                            console.log(res)
                            // Handle success
                            if (res.status == 'success') {
                                const shortUrl = STU_URL + '/' + res.alias;

                                setTimeout(() => {
                                    toastr.dismiss(notif);

                                    if (type == 'edit') {
                                        toastr.success('Link updated successfully');
                                    } else if (type == 'create') {
                                        toastr.success('Link created successfully');
                                        selector.querySelector("#i_rst").value = shortUrl;
                                        selector.querySelector(".stu_rst").classList.add("a");
                                        selector.querySelector(".stu_rst").scrollIntoView({
                                            behavior: "smooth",
                                            block: "center"
                                        });
                                    } else if (type == 'api') {
                                        toastr.success('API created successfully');    
                                    }
                                    n.classList.remove("a");
                                }, 1e3);
                            } else {
                                setTimeout(() => {
                                    toastr.dismiss(notif);
                                    toastr.error('Error: '+ res.message)+'!';
                                    n.classList.remove("a");
                                }, 1e3)
                            }
                        })
                        .catch((error) => {
                            toastr.dismiss(notif);
                            if (error.status) {
                                toastr.error('Error:', error.message);
                            } else {
                                toastr.error('Network error:', error);
                            }
                            console.log(error);

                        });            

                }
            }
        })
    }
    reset() {
        const toastr = this.toastr;
        const type = this.type;
        const selector = document.querySelector(this.select);
        const func = () => {
            Swal.fire({
                title: 'Đặt lại mẫu?'
                , text: "Bạn chắc chắn muốn đặt lại (reset) mẫu không?"
                , icon: "warning"
                , confirmButtonText: 'Chắc chắn!'
                , showCancelButton: true
                , cancelButtonText: 'Huỷ'
            })
            .then(result => {
                if (result.isConfirmed) {
                    if (type == 'create') {
                        localStorage.removeItem('input_STU');
                        localStorage.removeItem('btn_STU');
                    }
                    // Clear checkboxes
                    selector.querySelectorAll(".stu_b_ftr").forEach(checkbox => {
                        checkbox.classList.remove("a");
                    });
                    selector.querySelectorAll(".stu_ftr").forEach(checkbox => {
                        checkbox.classList.remove("a");
                    });
                    selector.querySelectorAll(".btn_iftr:not(.d)").forEach(checkbox => {
                        checkbox.classList.remove("a");
                    });
                    
                    // Reset html input
                    Array.from(selector.querySelectorAll(".stu_ftr_inp > *:not([data-cgroup='g_lnk1']), .stu_ftr_inp > *:not([data-cgroup='g_lnk1']) > label")).slice(2).forEach(e => {
                        e.classList.remove("a");
                    });
                    // Reset value input
                    selector.querySelectorAll(":not(#i_level).stu_fi").forEach(e => {
                        e.value = "";
                        e.removeAttribute("required");
                        e.classList.remove("ok");
                        e.classList.remove("er");
                    });
                    // Show notif
                    Swal.fire({
                        icon: "success",
                        title: "Đặt lại thành công!",
                        confirmButtonText: "Đóng",
                        timer: 2500
                    });
                }
            });
        }
                
        selector.querySelector("#rsSTU").addEventListener("click", function() {
            func();
        })
    }
    copy() {
        const toastr = this.toastr;
        const selector = document.querySelector(this.select);

        selector.querySelector(".stu_rst input ~ i").addEventListener("click", () => {
            selector.querySelector("#i_rst").select(), document.execCommand("copy");
            if (document.queryCommandSupported("copy")) {
                toastr.success("Đã sao chép URL thành công.")
            } else {
                toastr.error("Sao chép URL không được hỗ trợ trong trình duyệt này.")
            }
        });
    }
    validate() {
        const toastr = this.toastr;
        const selector = document.querySelector(this.select);

        selector.querySelectorAll(".stu_fi:not(.ndf)").forEach(input => {
            input.addEventListener("input", () => {
                if (input.classList.contains("er")) input.classList.remove("er");
            });

            input.addEventListener("change", () => {
                let element = input;
                let e = element.parentNode.dataset.group;
                let s = element.getAttribute("name");
                let n = element.dataset.in;
                let t = element;
                if (!element.value) return delete element.dataset.fill, element.classList.remove("ok"), void element.classList.remove("er");
                if (element.dataset.fill = !0, "sty" == t.name && t.classList.add("ok"), n && t.dataset.df) {
                    let a = fbSTU[n].dt.find(t => t.id == e).fi.find(t => t.i == s).df;
                    a || (a = fbSTU[n].df);
                    let r = (t, e) => {
                        let i = !1;
                        return e.forEach(e => {
                            t.includes(e) && (i = !0)
                        }), i
                    };
                    if (r(t.value, a)) t.classList.remove("er"), t.classList.add("ok");
                    else {
                        t.classList.remove("ok"), t.classList.add("er");
                        let o = toastr.error("Nhập url chứa: <b>" + a.join(", ") + "</b>");
                        t.focus();
                        // o.on("click", ({
                        //     t: e,
                        //     v: s
                        // }) => {
                        //     t.focus(), toastr.dismiss(o)
                        // })
                    }
                }
                if (!t.dataset.df && "url" == t.type) {
                    if (t.value.includes("://")) t.classList.remove("er"), t.classList.add("ok");
                    else {
                        t.classList.remove("ok"), t.classList.add("er");
                        let l = toastr.error("Vui lòng nhập liên kết..");
                        t.focus()
                        // l.on("click", ({
                        //     t: e,
                        //     v: s
                        // }) => {
                        //     t.focus(), toastr.dismiss(l)
                        // })
                    }
                }
                if (!t.dataset.df && "text" == t.type) {
                    if (t.value.includes("://")) {
                        t.classList.remove("ok"), t.classList.add("er");
                        let c = toastr.error("Đừng nhập liên kết ở đây..");
                        t.focus()
                        // c.on("click", ({
                        //     t: e,
                        //     v: s
                        // }) => {
                        //     t.focus(), toastr.dismiss(c)
                        // })
                    } else t.classList.remove("er"), t.classList.add("ok")
                }
                if (t.value && !t.dataset.df && "datetime-local" == t.type) {
                    if (Date.parse(new Date(t.value)) < Date.parse(new Date().toISOString().slice(0, 16))) {
                        t.classList.remove("ok"), t.classList.add("er");
                        let d = toastr.error("Ngày hết hạn không hợp lệ..");
                        t.focus()
                        // d.on("click", ({
                        //     t: e,
                        //     v: s
                        // }) => {
                        //     t.focus(), toastr.dismiss(d)
                        // })
                    } else t.classList.remove("er"), t.classList.add("ok")
                }
            });
        });
    }
    setOld() {
        const selector = document.querySelector(this.select)

        //localStorage
        let lsHandlerBtn = (action, key, value) => {
            let storedData = localStorage.getItem("btn_STU");
            let data = storedData ? JSON.parse(storedData) : {};

            if (action === "s" && key && value) {
                data[key] = value;
            } else if (action === "r" && key && data[key]) {
                delete data[key];
            }

            localStorage.setItem("btn_STU", JSON.stringify(data));
            return data;
        }
        let lsHandlerInp = (action, key, value) => {

            let storedData = localStorage.getItem("input_STU");
            let data = storedData ? JSON.parse(storedData) : {};

            if (action === "s" && key && value) {
                data[key] = value;
            } else if (action === "r" && key && data[key]) {
                delete data[key];
            }

            localStorage.setItem("input_STU", JSON.stringify(data));
            return data;
        }
        
        selector.querySelectorAll(".stu_fi:not(.ndf)").forEach(t => {
            t.addEventListener("change", () => {
                let e = t.getAttribute("name");
                t.classList.contains("ok") ? lsHandlerInp("s", e, t.value) : lsHandlerInp("r", e)
            })
        });
        selector.querySelectorAll(".btn_iftr:not(.d)").forEach(t => {
            t.addEventListener("click", () => {
                let e = t.dataset.id;
                e && (t.classList.contains("a") ? lsHandlerBtn("s", e, !0) : lsHandlerBtn("r", e))
            })
        });
    }
    request(methodXhr, urlXhr, CSRF_TOKEN, dataXhr) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open(methodXhr, urlXhr, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', CSRF_TOKEN);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        const res = JSON.parse(xhr.responseText);
                        resolve(res);
                    } else {
                        reject({ status: xhr.status, message: xhr.statusText });
                    }
                }
            };

            xhr.send(JSON.stringify(dataXhr));
        });
    }
}

class NOTE {
    constructor(config = {}) {
        this.select = config.select ? config.select : false;
        this.type = config.type ? config.type : 'create';
        if (this.type == 'edit') {
            const data = config.data;
            this.title = (data && data.title) ? data.title : false;
            this.content = (data && data.content) ? data.content : false;
            this.password = (data && data.password) ? data.password : false;
            this.alias = (data && data.alias) ? data.alias : false;
        }

        this.toastr = new Notyf({
            duration: 4500,
            position: {
                x: "center",
                y: "top"
            },
            dismissible: true
        });
        //
        this.loadSTU();
        this.validate();
        this.submit();
        this.reset();
        this.copy();

    }

    loadSTU() {
        const selector = document.querySelector(this.select);

        selector.innerHTML = `
            <form class="fgNOTE" id="fgNOTE">
                <div class="note_ftr_inp">
                    <div class="column">
                        <div class="input-box">
                            <label>Tiêu đề <span style="color: #f1416c">*</span></label>
                            <input ${this.title ? 'value="' + this.title + '"' : '' } type="text" id="n_title" name="n_title" placeholder="Nhập tiêu đề.." required>
                        </div>
                    </div> 
                    <div class="column">
                        <div class="input-box">
                            <label>Mật khẩu</label>
                            <input ${this.password ? 'value="' + this.password + '"' : ''} type="text" id="n_pasw" name="n_pasw" placeholder="Nhập mật khẩu.. (tuỳ chọn)">
                        </div>
                    </div>
                </div>    
                <div class="input-box" style="margin-top: 15px">
                    <label>Mô tả <span style="color: #f1416c">*</span></label>
                    <textarea id="editor" name="n_content" placeholder="Điền cái gì đó vào đây.."></textarea>
                </div>
                <div class="note_ftr_btn">
                    <button type="submit"> ${this.type == 'edit' ? 'Cập nhật ghi chú' : 'Tạo ghi chú'}</button>
                    <button id="rsNOTE" type="button">Đặt lại</button>
                </div>
                <div class="note_rst">
                    <div>
                        <input id="i_n_rst" type="url" name="rst" readonly="">
                        <span><svg fill="currentColor" viewBox="0 0 640 512"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg></span> <i>Copy</i>
                    </div>
                </div>
                </div>
            </form>
        `;
        const CR_TOKEN = document.head.querySelector("[name~=csrf-token]").content;

        ClassicEditor.create(selector.querySelector('#editor'), {
                language: document.documentElement.lang,
                ckfinder: {
                    uploadUrl: '/ckeditor/upload?_token=' + CR_TOKEN,
                },
                mediaEmbed: {
                    previewsInData: true
                },
                initialData: this.content
            })
            .catch(error => {
                console.error(error);
            }).then(newEditor => { window.editor = newEditor; });
    }
    submit() {
        const toastr = this.toastr;
        const type = this.type;
        const selector = document.querySelector(this.select);

        selector.querySelector("#fgNOTE").addEventListener("submit", event => {
            event.preventDefault();
            const elmError = selector.querySelector("label.a>.stu_fi.er");
            if (elmError) {
                elmError.focus();
            } else {
                let n = event.target.querySelector("[type=submit]");
                if (!n.classList.contains("a")) {
                    n.classList.add("a");
                    let ecSTU = t => btoa(encodeURIComponent(t)),
                        notif = toastr.success({
                            message: 
                            `<div class="xldg">
                                ${icSTU.gen}<span>Generating, please wait..</span>
                            </div>`
                            , duration: 0
                            , dismissible: false
                            , icon: false
                        });
                    selector.querySelector(".note_rst").classList.remove("a");
                    const objParams = {};

                    if (this.type == 'edit') objParams['alias'] = this.alias;
                    objParams['title'] = selector.querySelector("[name='n_title']").value;
                    objParams['password'] = selector.querySelector("[name='n_pasw']").value;
                    objParams['content'] = editor.getData();

                    const methodXhr = 'POST';
                    const urlXhr = type == 'create' ? '/note' : '/note/'+this.alias+'/update';
                    const CR_TOKEN = document.head.querySelector("[name~=csrf-token]").content;

                    this.request(methodXhr, urlXhr, CR_TOKEN, objParams)
                        .then((res) => {
                            // Handle success
                            if (res.status == 'success') {
                                const shortUrl = NOTE_URL + '/' + res.alias;

                                setTimeout(() => {
                                    toastr.dismiss(notif);

                                    if (type == 'edit') {
                                        toastr.success('Link updated successfully');
                                    } else if (type == 'create') {
                                        toastr.success('Link created successfully');
                                        selector.querySelector("#i_n_rst").value = shortUrl;
                                        selector.querySelector(".note_rst").classList.add("a");
                                        selector.querySelector(".note_rst").scrollIntoView({
                                            behavior: "smooth",
                                            block: "center"
                                        });
                                    }
                                    n.classList.remove("a");
                                }, 1e3);
                            } else {
                                setTimeout(() => {
                                    toastr.dismiss(notif);
                                    toastr.error('Error: '+ res.message)+'!';
                                    n.classList.remove("a");
                                }, 1e3)
                            }
                        })
                        .catch((error) => {
                            toastr.dismiss(notif);
                            if (error.status) {
                                toastr.error('Error:', error.message);
                            } else {
                                toastr.error('Network error:', error);
                            }
                            n.classList.remove("a");
                        });            

                }
            }
        })
    }
    reset() {
        const toastr = this.toastr;
        const type = this.type;
        const selector = document.querySelector(this.select);
        const func = () => {
            Swal.fire({
                title: 'Thất bại!'
                , icon: "warning"
            })
    
        }
                
        selector.querySelector("#rsNOTE").addEventListener("click", function() {
            func();
        })
    }
    copy() {
        const toastr = this.toastr;
        const selector = document.querySelector(this.select);

        selector.querySelector(".note_rst input ~ i").addEventListener("click", () => {
            selector.querySelector("#i_n_rst").select(), document.execCommand("copy");
            if (document.queryCommandSupported("copy")) {
                toastr.success("Đã sao chép URL thành công.")
            } else {
                toastr.error("Copying URL is not supported in this browser.")
            }
        });
    }
    validate() {
        const toastr = this.toastr;
        const selector = document.querySelector(this.select);

        selector.querySelectorAll(".stu_fi:not(.ndf)").forEach(input => {
            input.addEventListener("focus", () => {
                if (input.classList.contains("er")) input.classList.remove("er");
            });

            input.addEventListener("change", () => {
                let element = input;
                let e = element.parentNode.dataset.group;
                let s = element.getAttribute("name");
                let n = element.dataset.in;
                let t = element;
                if (!element.value) return delete element.dataset.fill, element.classList.remove("ok"), void element.classList.remove("er");
                if (element.dataset.fill = !0, "sty" == t.name && t.classList.add("ok"), n && t.dataset.df) {
                    let a = fbSTU[n].dt.find(t => t.id == e).fi.find(t => t.i == s).df;
                    a || (a = fbSTU[n].df);
                    let r = (t, e) => {
                        let i = !1;
                        return e.forEach(e => {
                            t.includes(e) && (i = !0)
                        }), i
                    };
                    if (r(t.value, a)) t.classList.remove("er"), t.classList.add("ok");
                    else {
                        t.classList.remove("ok"), t.classList.add("er");
                        let o = toastr.error("Enter the containing url: <b>" + a.join(", ") + "</b>");
                        o.on("click", ({
                            t: e,
                            v: s
                        }) => {
                            t.focus(), toastr.dismiss(o)
                        })
                    }
                }
                if (!t.dataset.df && "url" == t.type) {
                    if (t.value.includes("://")) t.classList.remove("er"), t.classList.add("ok");
                    else {
                        t.classList.remove("ok"), t.classList.add("er");
                        let l = toastr.error("Please enter links here..");
                        l.on("click", ({
                            t: e,
                            v: s
                        }) => {
                            t.focus(), toastr.dismiss(l)
                        })
                    }
                }
                if (!t.dataset.df && "text" == t.type) {
                    if (t.value.includes("://")) {
                        t.classList.remove("ok"), t.classList.add("er");
                        let c = toastr.error("Do not enter links here..");
                        c.on("click", ({
                            t: e,
                            v: s
                        }) => {
                            t.focus(), toastr.dismiss(c)
                        })
                    } else t.classList.remove("er"), t.classList.add("ok")
                }
                if (t.value && !t.dataset.df && "datetime-local" == t.type) {
                    if (Date.parse(new Date(t.value)) < Date.parse(new Date().toISOString().slice(0, 16))) {
                        t.classList.remove("ok"), t.classList.add("er");
                        let d = i.error("Invalid expiration date..");
                        d.on("click", ({
                            t: e,
                            v: s
                        }) => {
                            t.focus(), toastr.dismiss(d)
                        })
                    } else t.classList.remove("er"), t.classList.add("ok")
                }
            });
        });
    }

    request(methodXhr, urlXhr, CSRF_TOKEN, dataXhr) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open(methodXhr, urlXhr, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', CSRF_TOKEN);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        const res = JSON.parse(xhr.responseText);
                        resolve(res);
                    } else {
                        reject({ status: xhr.status, message: xhr.statusText });
                    }
                }
            };

            xhr.send(JSON.stringify(dataXhr));
        });
    }  
}
const cssSTU = ``;
const styleSTU = document.createElement("style");
styleSTU.textContent = cssSTU, document.head.appendChild(styleSTU); 

const icSTU = {
    ct: '<svg fill="currentColor" viewBox="0 0 24 24" fill="none"><path d="M7.93974 15.2602C7.84974 15.2602 7.76973 15.2502 7.67973 15.2102C6.86973 14.9102 6.18973 14.3202 5.75973 13.5502C4.75973 11.7502 5.37974 9.40017 7.12974 8.31017L9.46974 6.86015C10.3297 6.33015 11.3397 6.17018 12.2997 6.42018C13.2597 6.67018 14.0697 7.30016 14.5597 8.18016C15.5597 9.98016 14.9397 12.3302 13.1897 13.4202L12.9297 13.6102C12.5897 13.8502 12.1197 13.7702 11.8797 13.4402C11.6397 13.1002 11.7197 12.6302 12.0497 12.3902L12.3597 12.1702C13.4797 11.4702 13.8597 10.0202 13.2497 8.91017C12.9597 8.39017 12.4897 8.02016 11.9297 7.87016C11.3697 7.72016 10.7797 7.82017 10.2697 8.13017L7.92973 9.58016C6.84973 10.2502 6.46974 11.7002 7.07974 12.8202C7.32974 13.2702 7.72974 13.6202 8.20974 13.8002C8.59974 13.9402 8.79973 14.3702 8.64973 14.7602C8.53973 15.0702 8.24974 15.2602 7.93974 15.2602Z"/><path d="M12.66 17.6501C12.36 17.6501 12.05 17.6101 11.75 17.5301C10.79 17.2801 9.97997 16.6501 9.49997 15.7701C8.49997 13.9701 9.11996 11.6201 10.87 10.5301L11.13 10.3401C11.47 10.1001 11.94 10.1801 12.18 10.5101C12.42 10.8501 12.34 11.3201 12.01 11.5601L11.7 11.7801C10.58 12.4801 10.2 13.9301 10.81 15.0401C11.1 15.5601 11.57 15.9301 12.13 16.0801C12.69 16.2301 13.28 16.1301 13.79 15.8201L16.13 14.3701C17.21 13.7001 17.59 12.2501 16.98 11.1301C16.73 10.6801 16.33 10.3301 15.85 10.1501C15.46 10.0101 15.26 9.58011 15.41 9.19011C15.55 8.80011 15.98 8.60011 16.37 8.75011C17.18 9.05011 17.86 9.64012 18.29 10.4101C19.29 12.2101 18.67 14.5601 16.92 15.6501L14.58 17.1001C13.99 17.4601 13.33 17.6501 12.66 17.6501Z"/><path d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"/></svg>',
    bpm: '<svg fill="currentColor" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/><path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>',
    ttl: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M5,4V7H10.5V19H13.5V7H19V4H5Z"></path></svg>',
    sttl: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M2 4V7H7V19H10V7H15V4H2M21 9H12V12H15V19H18V12H21V9Z"></path></svg>',
    yt: '<svg fill="currentColor" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>',
    like: '<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2 8.996h3v12H2a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1Zm5.293-1.293 6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 7.996H21a2 2 0 0 1 2 2V12.1a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.62H8a1 1 0 0 1-1-1V8.41a1 1 0 0 1 .293-.707Z"></path></svg>',
    cm: '<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-4.172a1 1 0 0 0-.707.293l-1.867 1.867C11.054 22.361 9 21.51 9 19.812A.812.812 0 0 0 8.188 19H5a3 3 0 0 1-3-3V6Zm5 0a1 1 0 0 0 0 2h10a1 1 0 1 0 0-2H7Zm0 4a1 1 0 1 0 0 2h10a1 1 0 1 0 0-2H7Zm0 4a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2H7Z"></path></svg>',
    ig: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"></path></svg>',
    igl: '<svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M379.5 280.3l-110.6 114.2c-7.125 7.375-18.69 7.395-25.94 .0199L132.5 280.3C100.4 247.1 102.3 192.1 138.3 161.5C169.5 134.8 216.2 139.6 244.8 169.2l11.3 11.55l11.2-11.55c28.75-29.62 75.54-34.44 106.8-7.687C409.8 192.2 411.7 247.1 379.5 280.3z"/><path class="fa-secondary" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM379.5 280.3l-110.6 114.2c-7.125 7.375-18.69 7.395-25.94 .0199L132.5 280.3C100.4 247.1 102.3 192.1 138.3 161.5C169.5 134.8 216.2 139.6 244.8 169.2l11.3 11.55l11.2-11.55c28.75-29.62 75.54-34.44 106.8-7.687C409.8 192.2 411.7 247.1 379.5 280.3z"/></svg>',
    wa: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z"/></svg>',
    tg: '<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m20.665 3.72-17.73 6.837c-1.21.486-1.203 1.16-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.7H9.84l.002.002-.314 4.692c.46 0 .663-.211.92-.46l2.212-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.24-.473-1.8-1.282-1.434Z"></path></svg>',
    tk: '<svg fill="currentColor" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>',
    fileT:
        '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M5,4V7H10.5V19H13.5V7H19V4H5Z"></path></svg>',
    fileL:
        '<svg fill="currentColor" viewBox="0 0 640 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M41.41 270.7l133.3-133.3C202.3 109.8 238.5 96 274.6 96s72.36 13.8 99.96 41.41C402.2 165 415.1 201.2 416 237.4c.0004 36.18-13.8 72.36-41.41 99.97l-14.18 14.18c-18.78-1.197-36.33-8.753-49.75-22.18c-3.154-3.154-5.855-6.626-8.382-10.19l27.06-27.06c14.61-14.61 22.66-34.04 22.66-54.71s-8.049-40.1-22.66-54.71C314.7 168 295.3 160 274.6 160C253.1 160 234.5 168 219.9 182.7L86.66 315.9c-14.62 14.61-22.66 34.04-22.66 54.71s8.047 40.1 22.66 54.71C101.3 439.1 120.7 448 141.4 448c20.67 0 40.1-8.047 54.71-22.66l60.59-60.59c2.779 3.355 5.584 6.7 8.731 9.846c12.72 12.72 27.39 22.17 42.91 29.02l-66.98 66.98C213.7 498.2 177.6 512 141.4 512c-36.18 0-72.36-13.8-99.97-41.41C-13.8 415.4-13.8 325.9 41.41 270.7z"/><path class="fa-secondary" d="M598.6 241.3l-133.3 133.3C437.7 402.2 401.6 416 365.4 416s-72.36-13.8-99.96-41.41c-26.63-26.63-40.42-61.25-41.36-96.15C223 241 236.8 203.2 265.4 174.7L279.6 160.5c18.78 1.197 36.33 8.753 49.75 22.18c3.154 3.154 5.854 6.626 8.382 10.19L310.7 219.9c-14.61 14.61-22.66 34.04-22.66 54.71s8.049 40.1 22.66 54.71C325.3 343.1 344.7 352 365.4 352c20.67 0 40.1-8.049 54.71-22.66l133.3-133.3c14.62-14.61 22.66-34.04 22.66-54.71S567.1 101.3 553.3 86.66C538.7 72.05 519.3 64 498.6 64c-20.67 0-40.1 8.047-54.71 22.66l-60.59 60.59c-2.779-3.355-5.584-6.7-8.73-9.846c-12.72-12.72-27.39-22.17-42.91-29.02l66.98-66.98C426.3 13.8 462.4 0 498.6 0c36.18 0 72.36 13.8 99.96 41.41c27.11 27.11 40.9 62.48 41.39 98C640.5 176.2 626.7 213.2 598.6 241.3z"/></svg>',
    link: '<svg fill="currentColor" viewBox="0 0 640 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M41.41 270.7l133.3-133.3C202.3 109.8 238.5 96 274.6 96s72.36 13.8 99.96 41.41C402.2 165 415.1 201.2 416 237.4c.0004 36.18-13.8 72.36-41.41 99.97l-14.18 14.18c-18.78-1.197-36.33-8.753-49.75-22.18c-3.154-3.154-5.855-6.626-8.382-10.19l27.06-27.06c14.61-14.61 22.66-34.04 22.66-54.71s-8.049-40.1-22.66-54.71C314.7 168 295.3 160 274.6 160C253.1 160 234.5 168 219.9 182.7L86.66 315.9c-14.62 14.61-22.66 34.04-22.66 54.71s8.047 40.1 22.66 54.71C101.3 439.1 120.7 448 141.4 448c20.67 0 40.1-8.047 54.71-22.66l60.59-60.59c2.779 3.355 5.584 6.7 8.731 9.846c12.72 12.72 27.39 22.17 42.91 29.02l-66.98 66.98C213.7 498.2 177.6 512 141.4 512c-36.18 0-72.36-13.8-99.97-41.41C-13.8 415.4-13.8 325.9 41.41 270.7z"/><path class="fa-secondary" d="M598.6 241.3l-133.3 133.3C437.7 402.2 401.6 416 365.4 416s-72.36-13.8-99.96-41.41c-26.63-26.63-40.42-61.25-41.36-96.15C223 241 236.8 203.2 265.4 174.7L279.6 160.5c18.78 1.197 36.33 8.753 49.75 22.18c3.154 3.154 5.854 6.626 8.382 10.19L310.7 219.9c-14.61 14.61-22.66 34.04-22.66 54.71s8.049 40.1 22.66 54.71C325.3 343.1 344.7 352 365.4 352c20.67 0 40.1-8.049 54.71-22.66l133.3-133.3c14.62-14.61 22.66-34.04 22.66-54.71S567.1 101.3 553.3 86.66C538.7 72.05 519.3 64 498.6 64c-20.67 0-40.1 8.047-54.71 22.66l-60.59 60.59c-2.779-3.355-5.584-6.7-8.73-9.846c-12.72-12.72-27.39-22.17-42.91-29.02l66.98-66.98C426.3 13.8 462.4 0 498.6 0c36.18 0 72.36 13.8 99.96 41.41c27.11 27.11 40.9 62.48 41.39 98C640.5 176.2 626.7 213.2 598.6 241.3z"/></svg>',
    pass: '<svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M336 0c-97.2 0-176 78.8-176 176c0 14.71 2.004 28.93 5.406 42.59l128 127.1C307.1 349.1 321.3 351.1 336 351.1c97.2 0 176-78.8 176-176S433.2 0 336 0zM376 176c-22.09 0-40-17.91-40-40S353.9 96 376 96S416 113.9 416 136S398.1 176 376 176z"/><path class="fa-secondary" d="M165.4 218.6l-156 156C3.371 380.6 0 388.8 0 397.3V496C0 504.8 7.164 512 16 512l96 0c8.836 0 16-7.164 16-16v-48h48c8.836 0 16-7.164 16-16v-48h57.37c4.242 0 8.312-1.688 11.31-4.688l32.72-32.72L165.4 218.6z"/></svg>',
    style: '<svg viewBox="0 0 32 32"><g><path d="M24,3H8A5,5,0,0,0,3,8V24a5,5,0,0,0,5,5H24a5,5,0,0,0,5-5V8A5,5,0,0,0,24,3Zm3,21a3,3,0,0,1-3,3H8a3,3,0,0,1-3-3V8A3,3,0,0,1,8,5H24a3,3,0,0,1,3,3Z"></path> <path d="M14.5,12H18a1,1,0,0,1,1,1,1,1,0,0,0,2,0,3,3,0,0,0-3-3H14.5a3.5,3.5,0,0,0,0,7h3a1.5,1.5,0,0,1,0,3H14a1,1,0,0,1-1-1,1,1,0,0,0-2,0,3,3,0,0,0,3,3h3.5a3.5,3.5,0,0,0,0-7h-3a1.5,1.5,0,0,1,0-3Z"></path></g></svg>',
    note: '<svg width="46" height="46" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.fa-secondary{opacity:.4}</style></defs><path fill-rule="evenodd" d="M6 2a1 1 0 0 1 1 1v2h2a1 1 0 0 1 0 2H7v2a1 1 0 0 1-2 0V7H3a1 1 0 0 1 0-2h2V3a1 1 0 0 1 1-1Z" clip-rule="evenodd"></path><path fill-rule="evenodd" class="fa-secondary" d="M12 6h5a1 1 0 1 1 0 2h-5.341a5.997 5.997 0 0 1-1.187 2H17a1 1 0 1 1 0 2H7a.998.998 0 0 1-.287-.042A5.978 5.978 0 0 1 2 10.472V19a3 3 0 0 0 3 3h9v-5a3 3 0 0 1 3-3h5V5a3 3 0 0 0-3-3h-8.528A5.978 5.978 0 0 1 12 6Zm4 15.883a3 3 0 0 0 1.293-.762l3.828-3.828A3 3 0 0 0 21.883 16H17a1 1 0 0 0-1 1v4.883ZM6 15a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Z" clip-rule="evenodd</path</svg>',
    tw: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path></svg>',
    exp: '<svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M239 272.1c4.688 4.688 10.83 7.031 16.97 7.031c6.141 0 12.28-2.344 16.97-7.031c9.375-9.375 9.375-24.56 0-33.94l-79.1-80c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94L239 272.1z"/><path class="fa-secondary" d="M389.8 56.49c-41.56-28.35-92.1-40.48-142.4-40.49C234.5 15.1 223.1 26.41 223.1 39.26l0 71.05c0 15.95 10.9 30.72 26.64 33.28c20.06 3.261 37.39-12.13 37.39-31.57V83.14c48.13 8.809 91.06 36.96 118.7 81.6c35.56 57.32 34.37 130.7-2.792 187c-63.63 96.38-195.3 106-272.5 28.81C69.43 318.5 63.47 221.3 113.6 152.4c9.276-12.73 8.662-30.08-2.477-41.22C96.12 96.21 73.86 98.17 61.41 115.4c-67.92 93.8-59.65 226 24.8 310.5c46.8 46.79 108.3 70.21 169.8 70.18c61.49 0 122.1-23.38 169.8-70.18C530.2 321.4 518.2 144.1 389.8 56.49z"/></svg>',
    thumb:
        '<svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z"/><path class="fa-secondary" d="M464 32h-416C21.49 32 0 53.49 0 80v352C0 458.5 21.49 480 48 480h416c26.51 0 48-21.49 48-48v-352C512 53.49 490.5 32 464 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z"/></svg>',
    df: '<svg fill="currentColor" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>',
    rst: '<svg fill="currentColor" viewBox="0 0 640 512"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg>',
    load: '<svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M283.2 65.92C267.6 63.69 256 50.32 256 34.52c0-19.38 17.19-34.69 36.38-31.95C416.4 20.29 512 127.2 512 256c0 33.38-6.544 65.26-18.27 94.49c-7.162 17.86-28.85 24.87-45.56 15.32c-13.74-7.854-19.62-24.53-13.75-39.23C443.2 304.7 448 280.9 448 256C448 159.4 376.3 79.18 283.2 65.92z"/><path class="fa-secondary" d="M493.7 350.5C456 444.9 363.7 512 256 512c-141.2 0-256-114.8-256-256s114.8-256 256-256c11.91 0 23.54 1.104 35.03 2.686C272.4 .8672 256 15.62 256 34.52c0 15.8 11.58 29.17 27.23 31.4c.9648 .1367 1.844 .5116 2.805 .6639C276.2 65.04 266.2 64 256 64C150.1 64 64 150.1 64 256s86.13 192 192 192c81.67 0 151.4-51.34 179.1-123.4c-.248 .6406-.4215 1.317-.6754 1.954c-5.869 14.7 .0045 31.38 13.75 39.23C464.8 375.3 486.5 368.2 493.7 350.5z"/></svg>',
    chevr:
        '<svg fill="currentColor" viewBox="0 0 448 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M224 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L370.8 256L201.4 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C240.4 476.9 232.2 480 224 480z"/><path class="fa-secondary" d="M32 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L9.375 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C48.38 476.9 40.19 480 32 480z"/></svg>',
    check:
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>check-decagram</title><path d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z" /></svg>',
    fb: '<svg fill="currentColor" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>',
    dc: '<svg fill="currentColor" viewBox="0 0 640 512"><path d="M524.531,69.836a1.5,1.5,0,0,0-.764-.7A485.065,485.065,0,0,0,404.081,32.03a1.816,1.816,0,0,0-1.923.91,337.461,337.461,0,0,0-14.9,30.6,447.848,447.848,0,0,0-134.426,0,309.541,309.541,0,0,0-15.135-30.6,1.89,1.89,0,0,0-1.924-.91A483.689,483.689,0,0,0,116.085,69.137a1.712,1.712,0,0,0-.788.676C39.068,183.651,18.186,294.69,28.43,404.354a2.016,2.016,0,0,0,.765,1.375A487.666,487.666,0,0,0,176.02,479.918a1.9,1.9,0,0,0,2.063-.676A348.2,348.2,0,0,0,208.12,430.4a1.86,1.86,0,0,0-1.019-2.588,321.173,321.173,0,0,1-45.868-21.853,1.885,1.885,0,0,1-.185-3.126c3.082-2.309,6.166-4.711,9.109-7.137a1.819,1.819,0,0,1,1.9-.256c96.229,43.917,200.41,43.917,295.5,0a1.812,1.812,0,0,1,1.924.233c2.944,2.426,6.027,4.851,9.132,7.16a1.884,1.884,0,0,1-.162,3.126,301.407,301.407,0,0,1-45.89,21.83,1.875,1.875,0,0,0-1,2.611,391.055,391.055,0,0,0,30.014,48.815,1.864,1.864,0,0,0,2.063.7A486.048,486.048,0,0,0,610.7,405.729a1.882,1.882,0,0,0,.765-1.352C623.729,277.594,590.933,167.465,524.531,69.836ZM222.491,337.58c-28.972,0-52.844-26.587-52.844-59.239S193.056,219.1,222.491,219.1c29.665,0,53.306,26.82,52.843,59.239C275.334,310.993,251.924,337.58,222.491,337.58Zm195.38,0c-28.971,0-52.843-26.587-52.843-59.239S388.437,219.1,417.871,219.1c29.667,0,53.307,26.82,52.844,59.239C470.715,310.993,447.538,337.58,417.871,337.58Z"/></svg>',
    unlock: '<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18 10H9V7c0-1.654 1.346-3 3-3s3 1.346 3 3h2c0-2.757-2.243-5-5-5S7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Zm-7.939 5.499A2.002 2.002 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723V20h-2v-2.277a1.992 1.992 0 0 1-.939-2.224Z"></path></svg>',
    gen: '<svg fill="currentColor" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M283.2 65.92C267.6 63.69 256 50.32 256 34.52c0-19.38 17.19-34.69 36.38-31.95C416.4 20.29 512 127.2 512 256c0 33.38-6.544 65.26-18.27 94.49c-7.162 17.86-28.85 24.87-45.56 15.32c-13.74-7.854-19.62-24.53-13.75-39.23C443.2 304.7 448 280.9 448 256C448 159.4 376.3 79.18 283.2 65.92z"/><path class="fa-secondary" d="M493.7 350.5C456 444.9 363.7 512 256 512c-141.2 0-256-114.8-256-256s114.8-256 256-256c11.91 0 23.54 1.104 35.03 2.686C272.4 .8672 256 15.62 256 34.52c0 15.8 11.58 29.17 27.23 31.4c.9648 .1367 1.844 .5116 2.805 .6639C276.2 65.04 266.2 64 256 64C150.1 64 64 150.1 64 256s86.13 192 192 192c81.67 0 151.4-51.34 179.1-123.4c-.248 .6406-.4215 1.317-.6754 1.954c-5.869 14.7 .0045 31.38 13.75 39.23C464.8 375.3 486.5 368.2 493.7 350.5z"/></svg>'

};
const fbSTU = {
yt: {
    tx: 'YouTube',
    clr: '#ff0000',
    sclr: '#9f0000',
    df: ['youtube.com/@', 'youtube.com/channel', 'youtube.com/c', 'youtube.com/watch?v=', 'youtu.be'],
    fb: 1,
    dt: [
        { id: 'g_yt1', name: STUtxt.yt1_n, fi:
            [
                { i: 'yt1', t: 'url', ic: 'yt', r: 1, ph: STUtxt.yt1_ph }
            ]
        },
        { id: 'g_yt2', name: STUtxt.yt2_n, fi: 
        [{ i: 'yt2', t: 'url', ic: 'yt', r: 1, ph: STUtxt.yt2_ph }] },
        { id: 'g_yt3', name: STUtxt.yt3_n, fi: 
        [{ i: 'yt3', t: 'url', ic: 'yt', r: 1, ph: STUtxt.yt3_ph }] },
        {
            id: 'g_ytl1',
            name: 'Like',
            fi: [{ i: 'ytl1', t: 'url', ic: 'like', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'], ph: STUtxt.ytl1_ph }],
        },
        {
           id: 'g_ytl2',
           name: 'Like #2',
           fi: [{ i: 'ytl2', t: 'url', ic: 'like', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'], ph: STUtxt.ytl2_ph }],
        },
        {
           id: 'g_ytl3',
           name: 'Like #3',
           fi: [{ i: 'ytl3', t: 'url', ic: 'like', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'], ph: STUtxt.ytl3_ph }],
        },
        {
            id: 'g_ytc1',
            name: 'Comment',
            fi: [{ i: 'ytc1', t: 'url', ic: 'cm', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'], ph: STUtxt.ytc1_ph }],
        },
        {
           id: 'g_ytc2',
           name: 'Comment #2',
           fi: [{ i: 'ytc2', t: 'url', ic: 'cm', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'], ph: STUtxt.ytc2_ph }],
        },
        // {
        //     id: 'g_ytlc1',
        //     name: 'Like + Comment',
        //     fi: [{ i: 'ytlc1', t: 'url', ic: 'like', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'], ph: 'Youtube Video URL link..' }],
        // },
        // {
        //    id: 'g_ytlc3',
        //    name: 'Comment #3',
        //    fi: [{ i: 'ytlc3', t: 'url', ic: 'cm', r: 1, df: ['youtube.com/watch?v=', 'youtu.be'] }],
        // },
    ],
},

// wa: {
//     tx: 'WhatsApp',
//     clr: '#25D366',
//     sclr: '#1F9E4F',
//     df: ['whatsapp.com'],
//     fb: 1,
//     dt: [
//         { id: 'g_wa1', name: 'Join', fi: [{ i: 'wa1', t: 'url', ic: 'wa', r: 1, ph: 'Whatsapp URL link..' }] },
//         { id: 'g_wa2', name: '2nd Join', fi: [{ i: 'wa2', t: 'url', ic: 'wa', r: 1, ph: 'Whatsapp URL link..' }] },
//         { id: 'g_wa3', name: 'Join #3', fi: [{ i: 'wa3', t: 'url', ic: 'wa', r: 1 }] },
//     ],
// },

tg: {
    tx: 'Telegram',
    clr: '#0088cc',
    sclr: '#186389',
    df: ['t.me'],
    fb: 1,
    dt: [
        { id: 'g_tg1', name: 'Join Group', fi: [{ i: 'tg1', t: 'url', ic: 'tg', r: 1, ph: STUtxt.tg1_ph }] },
        { id: 'g_tg2', name: 'Join Group #2', fi: [{ i: 'tg2', t: 'url', ic: 'tg', r: 1, ph: STUtxt.tg2_ph }] },
        { id: 'g_tg3', name: 'Join Group #3', fi: [{ i: 'tg3', t: 'url', ic: 'tg', r: 1, ph: STUtxt.tg3_ph }] },
    ],
},

tk: {
    tx: 'TikTok',
    clr: '#000000',
    sclr: '#363636',
    ics: 1,
    df: ['tiktok.com'],
    fb: 1,
    dt: [
        { id: 'g_tk1', name: 'Follow', fi: [{ i: 'tk1', t: 'url', ic: 'tk', r: 1, ph: STUtxt.tk1_ph }] },
        { id: 'g_tk2', name: 'Follow #2', fi: [{ i: 'tk2', t: 'url', ic: 'tk', r: 1, ph: STUtxt.tk2_ph }] },
        { id: 'g_tk3', name: 'Follow #3', fi: [{ i: 'tk3', t: 'url', ic: 'tk', r: 1, ph: STUtxt.tk3_ph }] },
        { id: 'g_tkl1', name: 'Like', fi: [{ i: 'tkl1', t: 'url', ic: 'tk', r: 1, ph: STUtxt.tkl1_ph }] },
        { id: 'g_tkl2', name: 'Like #2', fi: [{ i: 'tkl2', t: 'url', ic: 'tk', r: 1, ph: STUtxt.tkl2_ph }] },
        { id: 'g_tkl3', name: 'Like #3', fi: [{ i: 'tkl3', t: 'url', ic: 'tk', r: 1, ph: STUtxt.tkl3_ph }] },
    ],
},

ig: {
    tx: 'Instagram',
    clr: '#5851DB',
    sclr: '#3E39A6',
    df: ['instagram.com'],
    fb: 1,
    dt: [
        { id: 'g_ig1', name: 'Follow', fi: [{ i: 'ig1', t: 'url', ic: 'ig', r: 1, ph: STUtxt.ig1_ph }] },
        { id: 'g_ig2', name: 'Follow #2', fi: [{ i: 'ig2', t: 'url', ic: 'ig', r: 1, ph: STUtxt.ig2_ph }] },
        { id: 'g_ig3', name: 'Follow #3', fi: [{ i: 'ig3', t: 'url', ic: 'ig', r: 1, ph: STUtxt.ig3_ph }] },
        { id: 'g_igl1', name: 'Like', fi: [{ i: 'igl1', t: 'url', ic: 'igl', r: 1, df: ['instagram.com'], ph: STUtxt.igl1_ph }] },
        { id: 'g_igl2', name: 'Like #2', fi: [{ i: 'igl2', t: 'url', ic: 'igl', r: 1, df: ['instagram.com'], ph: STUtxt.igl2_ph }] },
        { id: 'g_igl3', name: 'Like #3', fi: [{ i: 'igl3', t: 'url', ic: 'igl', r: 1, df: ['instagram.com'], ph: STUtxt.igl3_ph }] },
    ],
},

fb: {
    tx: 'Facebook',
    clr: '#395693',
    sclr: '#1d2c4b',
    df: ['facebook.com'],
    fb: 1,
    dt: [
        { id: 'g_fb1', name: 'Follow', fi: [{ i: 'fb1', t: 'url', ic: 'fb', r: 1, ph: STUtxt.fb1_ph }] },
        { id: 'g_fb2', name: 'Follow #2', fi: [{ i: 'fb2', t: 'url', ic: 'fb', r: 1, ph: STUtxt.fb2_ph }] },
        { id: 'g_fb3', name: 'Follow #3', fi: [{ i: 'fb3', t: 'url', ic: 'fb', r: 1, ph: STUtxt.fb3_ph }] },
        { id: 'g_fbl1', name: 'Like', fi: [{ i: 'fbl1', t: 'url', ic: 'fb', r: 1, ph: STUtxt.fbl1_ph }] },
        { id: 'g_fbl2', name: 'Like #2', fi: [{ i: 'fbl2', t: 'url', ic: 'fb', r: 1, ph: STUtxt.fbl2_ph }] },
        { id: 'g_fbl3', name: 'Like #3', fi: [{ i: 'fbl3', t: 'url', ic: 'fb', r: 1, ph: STUtxt.fbl3_ph }] },
    ],
},

// tw: {
//     tx: 'Twitter',
//     clr: '#00acee',
//     sclr: '#0089b2',
//     df: ['twitter.com'],
//     fb: 1,
//     dt: [
//         { id: 'g_tw1', name: 'Follow', fi: [{ i: 'tw1', t: 'url', ic: 'tw', r: 1, ph: 'Twitter URL for Follow..' }] },
//         { id: 'g_tw2', name: 'Follow #2', fi: [{ i: 'tw2', t: 'url', ic: 'tw', r: 1, ph: 'Twitter URL for Follow #2..' }] },
//         { id: 'g_tw3', name: 'Follow #3', fi: [{ i: 'tw3', t: 'url', ic: 'tw', r: 1, ph: 'Twitter URL for Follow #3..' }] },
//         { id: 'g_twl1', name: 'Like', fi: [{ i: 'twl1', t: 'url', ic: 'tw', r: 1, ph: 'Twitter URL for Like..' }] },
//         { id: 'g_twl2', name: 'Like #2', fi: [{ i: 'twl2', t: 'url', ic: 'tw', r: 1, ph: 'Twitter URL for Like #2..' }] },
//         { id: 'g_twl3', name: 'Like #3', fi: [{ i: 'twl3', t: 'url', ic: 'tw', r: 1, ph: 'Twitter URL for Like #3..' }] },
//     ],
// },

dc: {
    tx: 'Discord',
    clr: '#7289DA',
    sclr: '#4E6397',
    df: ['discord.com'],
    fb: 1,
    dt: [
        { id: 'g_dc1', name: 'Join', fi: [{ i: 'dc1', t: 'url', ic: 'dc', r: 1, ph: STUtxt.dc1_ph }] },
        { id: 'g_dc2', name: 'Join #2', fi: [{ i: 'dc2', t: 'url', ic: 'dc', r: 1, ph: STUtxt.dc2_ph }] },
        { id: 'g_dc3', name: 'Join #3', fi: [{ i: 'dc3', t: 'url', ic: 'dc', r: 1, ph: STUtxt.dc3_ph }] },
    ],
},

ct: {
    tx: 'Custom',
    clr: '#834bba',
    sclr: '#1F9E4F',
    fb: 1,
    dt: [
        { id: 'g_ct1', name: STUtxt.ct1_n, fi: [
                                            { i: 'ct1t', t: 'text', ic: 'ct', r: 1, ph: STUtxt.ct1t_ph },
                                            { i: 'ct1', t: 'url', ic: 'ct', r: 1, ph: STUtxt.ct1_ph }
                                        ]},
        { id: 'g_ct2', name: STUtxt.ct2_n, fi: [
                                                { i: 'ct2t', t: 'text', ic: 'ct', r: 1, ph: STUtxt.ct2t_ph },
                                                { i: 'ct2', t: 'url', ic: 'ct', r: 1, ph: STUtxt.ct2_ph }
                                            ] },
        { id: 'g_ct3', name: STUtxt.ct3_n, fi: [
                                                { i: 'ct3t', t: 'text', ic: 'ct', r: 1, ph: STUtxt.ct3t_ph },
                                                { i: 'ct3', t: 'url', ic: 'ct', r: 1, ph: STUtxt.ct3_ph }
                                            ]},
    ],
},

file: {
    tx: 'Destination',
    clr: '#00cd4d',
    sclr: '#008835',
    grp: 1,
    dt: [
        {
            id: 'g_lnk1',
            name: 'Link',
            fi: [
                { i: 'lnk1t', t: 'text', ic: 'fileT', ph: STUtxt.lnk1t_ph, a: 1, ro: true},
                { i: 'lnk1', t: 'url', ic: 'fileL', ph:  STUtxt.lnk1_ph, a: 1, r: 1, l: 1, ro: true},
            ],
        },

        {
            id: 'g_lnk2',
            name: 'Link #2',
            fi: [
                { i: 'lnk2t', t: 'text', ic: 'fileT', ph:  STUtxt.lnk2t_ph, ro: true},
                { i: 'lnk2', t: 'url', ic: 'fileL', ph:  STUtxt.lnk2_ph, r: 1, l: 1, ro: true},
            ],
        },

        {
            id: 'g_lnk3',
            name: 'Link #3',
            fi: [
                { i: 'lnk3t', t: 'text', ic: 'fileT', ph:  STUtxt.lnk3t_ph, ro: true},
                { i: 'lnk3', t: 'url', ic: 'fileL', ph:  STUtxt.lnk3_ph, r: 1, l: 1, ro: true},
            ],
        },

        {
            id: 'g_lnk4',
            name: 'Link #4',
            fi: [
                { i: 'lnk4t', t: 'text', ic: 'fileT', ph:  STUtxt.lnk4t_ph, ro: true},
                { i: 'lnk4', t: 'url', ic: 'fileL', ph:  STUtxt.lnk4_ph, r: 1, l: 1, ro: true},
            ],
        },

        {
            id: 'g_lnk5',
            name: 'Link #5',
            fi: [
                { i: 'lnk5t', t: 'text', ic: 'fileT', ph:  STUtxt.lnk5t_ph, ro: true},
                { i: 'lnk5', t: 'url', ic: 'fileL', ph:  STUtxt.lnk5_ph, r: 1, l: 1, ro: true},
            ],
        },
    ],
},

oth: {
    tx: STUtxt.advanced_options,
    clr: '#3300cc',
    sclr: '#9f0000',
    dt: [
        {
            id: 'g_pwd',
            name: 'Password',
            fi: [{ i: 'pwd', t: 'text', ic: 'pass', r: 1, ph: STUtxt.pwd_ph, attr: [{ minlength: 1 }, { maxlength: 8 }] }],
        },
        { id: 'g_not', name: 'Note', fi: [{ i: 'note', t: 'text', ic: 'note', r: 1, ph: STUtxt.not_ph }] },
        { id: 'g_sty', name: 'Style', fi: [{ i: 'sty', t: 'select', ic: 'style', r: 1, ph: STUtxt.sty_ph, opts: [['1', 'Kiểu 1 (Mặc định)'], ['2', 'Kiểu 2']] }] },
        {
            id: 'g_exp',
            name: 'Expired',
            fi: [{ i: 'exp', t: 'datetime-local', ic: 'exp', r: 1, ph: STUtxt.exp_ph, attr: [{ min: new Date().toISOString().slice(0, 16) }] }],
        },
        {
            id: 'g_thmb',
            name: 'Thumbnail',
            fi: [
                // { i: 'image', t: 'file', ic: 'thumb', ndf: 1, attr: [{ accept: 'image/*' }] },
                { i: 'thmb', t: 'url', ic: 'thumb', r: 1, ph: STUtxt.thmb_ph, ndf: 1, img: 1 },
            ],
        },
    ],
},
};
