function scroll_to_right(){
    let scroll_right = document.querySelectorAll('.scroll-right');
    scroll_right.forEach(element => {
        $(element).siblings('div.table-responsive').scroll(function(){
            $(element).removeClass('d-none');
            if($(this).scrollLeft() == 1 || $(this).scrollLeft() == 0){
                $(element).addClass('d-none');
            }
        });
        $(element).click(function(){
            $(element).siblings('div.table-responsive').animate({
                scrollLeft: 0
            }, 300);
        })
    });
}
radios_save_lesson_disabled_function();
    function radios_save_lesson_disabled_function(){
      let radios_save_lesson_disabled = Array.from($(".radio-save-lesson-disabled"));
        $(radios_save_lesson_disabled).click(function(e) {
          e.preventDefault();
        });
    }
function style_function(page_color){
    const L_L_a = document.querySelectorAll(".list-path li a");
    if(L_L_a){
        for (let i = 0; L_L_a[i] ; i++) {
        L_L_a[i].classList.add(`border-${page_color}`);
        }
    }
    const Tr_Rm_B = document.querySelectorAll(".TI-RM-B");
    if(Tr_Rm_B){
        for (let i = 0; Tr_Rm_B[i] ; i++) {
        Tr_Rm_B[i].classList.add('btn',`bg-gradient-${page_color}`);
        }
    }
    const H2 = document.querySelectorAll(".header-2");
    if(H2){
        for (let i = 0; H2[i] ; i++) {
        H2[i].classList.add(`border-${page_color}`,`text-${page_color}`);
        }
    }
    const H3 = document.querySelectorAll("h3");
    if(H3){
        for (let i = 0; H3[i] ; i++) {
        H3[i].classList.add(`text-${page_color}`);
        }
    }
    const H2N = document.querySelectorAll(".header-2-number");
    if(H2N){
        for (let i = 0; H2N[i] ; i++) {
        H2N[i].classList.add(`text-${page_color}`);
        }
    }
    const C_B_L = document.querySelectorAll(".code-box-line");
    if(C_B_L){
        for (let i = 0; C_B_L[i] ; i++) {
        C_B_L[i].classList.add(`text-${page_color}`,`border-${page_color}`);
        }
    }
}
ordered_questions();
function ordered_questions(){
    let all_questions = [...document.querySelectorAll(".all-questions")];
    let options_question;
    all_questions.forEach(question => {
        options_question = [...$(question).find('div .option')];
        options_question.forEach(option => {
            y=Math.floor(Math.random() *20);
            option.style.order=y;
        });
    });
}