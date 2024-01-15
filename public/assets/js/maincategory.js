
function create_ele_img(){
    let items_width = 112;
    let items_border = 8;
    let SLPosition = -1;
    let WIWidth = Math.ceil(window.innerWidth/100) + 1;
    for (let i = 0; i < 2; i++) {
        for (let y = 1; y < WIWidth; y++) {
            let first = document.createElement('div');
            $(first).addClass('first');
            let second = document.createElement('div');
            $(second).addClass('second');
            let third = document.createElement('div');
            $(third).addClass('third');
            let items = document.createElement('div');
            $(items).addClass('items').append(first, second, third);
            if(i == 0){
            $(items).css({
                'left' : `${(y * items_width) - (y * items_border)}px`
            });
            }else{
            $(items).css({
                'left' : `${SLPosition * 52}px`,
                'top' : '90px'
            });
            SLPosition += 2;
            }
            $('.container-items').append(items);            
        }
    }
}
  