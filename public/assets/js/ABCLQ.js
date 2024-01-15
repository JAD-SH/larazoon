$(document).ready(function(){
    active_copy_btns();
    create_copy_btns();
});

function create_save_btn(page_color,route){
    let formSave = document.createElement("form");
    $(formSave).attr("action",route).attr("method","POST").attr('class','d-lg-none');

    let csrfInput = document.createElement("input");
    $(csrfInput).attr("name","_token").attr("value","{{csrf_token()}}").attr("type","hidden");
    formSave.appendChild(csrfInput);

    let btnSave = document.createElement("button");
    btnSave.classList.add('scroll-button','p-2','rounded-5',`bg-gradient-${page_color}`,'mx-auto','my-2','d-flex','justify-content-center','align-items-center','ajax-submit');

    let plusIcon = document.createElement("i");
    plusIcon.classList.add('fs-4','fa-solid','fa-plus');
    btnSave.appendChild(plusIcon);

    formSave.appendChild(btnSave);
    document.querySelector('.scroll-buttons-continer').appendChild(formSave);
}
function create_save_btn_not_verify(page_color,route){
    let btnSave = document.createElement("button");
    btnSave.classList.add('scroll-button','p-2','rounded-5',`bg-gradient-${page_color}`,'mx-auto','my-2','d-flex','justify-content-center','align-items-center','d-lg-none');
    $(btnSave).attr('data-bs-toggle','modal').attr('data-bs-target','#LoginModal');
    let plusIcon = document.createElement("i");
    plusIcon.classList.add('fs-4','fa-solid','fa-plus');
    btnSave.appendChild(plusIcon);
    document.querySelector('.scroll-buttons-continer').appendChild(btnSave);
}

function active_copy_btns(){
    let copy_btns = document.querySelectorAll(".copy-btn");
    if(copy_btns){
        copy_btns.forEach(btn => {
            btn.onclick=function(){
                if(copy_btns){
                    copy_btns.forEach(element => {
                        $(element).removeClass("bg-gradient-info");
                        $(element).addClass("bg-gradient-primary");
                    });
                }
                $(this).removeClass("bg-gradient-primary");
                $(this).addClass("bg-gradient-info");
                let text=$(this).siblings('pre').children('code').text();
                navigator.clipboard.writeText(text);
                $(btn).css('color','initial');
            }
        });
    }
} 

function create_copy_btns(){
    let pre_code=$(".code-toolbar .toolbar");
    let pre_code_arr =[...pre_code];
    pre_code_arr.forEach(element => {
      $(element).before('<button class="copy-btn position-absolute btn bg-gradient-primary py-1 px-3 m-0 fs-6 fw-bolder" style="z-index:1;"><i class="fs-4 fa-regular fa-paste"></i></button>');
    });
}