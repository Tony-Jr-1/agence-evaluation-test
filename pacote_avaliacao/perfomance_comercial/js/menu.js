$(function(){
    
    var openMenu = true;
    var windowSize = $(window)[0].innerWidth;

    var targetSizeMenu = windowSize;
    
    var targetSizeMenu = (windowSize <= 580) ? 200 : 300;
   
    if(windowSize <= 768){
        $('.menu').css('width','0').css('padding','0');
        openMenu = false;
        targetSizeMenu = 200;
    }

    $('.btn-menu').click(function(){
        if(openMenu){
            //Menu fechado
            $('.menu').animate({'width':'0','padding':'0'},function(){
                openMenu = false;
            });
            $('.painel-content, header').css('width','100%');
            $('.painel-content, header').animate({'left':'0'},function(){
                openMenu = false;
            });

        }else{
            //Menu aberto
            $('.menu').css('display','block');
            $('.menu').animate({'width':targetSizeMenu+'px','padding':'20px 0'},function(){
                openMenu = true;
            });
                                  
            if(windowSize > 768)
                $('.painel-content, header').css('width','calc(100% - 300px)');
                $('.painel-content, header').animate({'left':targetSizeMenu+'px'},function(){
                    openMenu = true;
                });

        }
    })

    $(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		targetSizeMenu = (windowSize <= 580) ? 200 : 300;
		if(windowSize <= 768){
			$('.menu').css('width','0').css('padding','0');
			$('.painel-content, header').css('width','100%').css('left','0');
			openMenu = false;
            targetSizeMenu = 200;
		}else{
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'20px 0'},function(){
				openMenu = true;
			});

			$('.painel-content, header').css('width','calc(100% - 300px)');
			$('.painel-content, header').animate({'left':targetSizeMenu+'px'},function(){
			    openMenu = true;
			});
		}

	})

})
