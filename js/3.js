setInterval(function(){

                var img=document.createElement("img");

                img.src="img/xue.gif";

                div.appendChild(img);

                array.push(img);

 

                img.style.position="absolute";

                img.style.top="0px";

                img.style.webkitTransition="all 10s";

                //随机雪花大小

                var imgWidth=parseInt(Math.random()*10000000)%14+12;

                img.width=imgWidth;

 

                //随机雪花位置

                var left=parseInt(Math.random()*10000000)%(screen.availWidth-imgWidth);

                img.style.left=left+"px";

                //随机雪花结束位置

                var leftDown=parseInt(Math.random()*10000000)%(screen.availWidth-imgWidth);

                var topDown=screen.availHeight+parseInt(Math.random()*10000000)%(100);

                //随机雪花角度

                var deg=parseInt(Math.random()*10000000)%360+360;

 

                //自定义两个属性 用来存储随机的结束位置

                img.setAttribute("leftDown",leftDown);

                img.setAttribute("topDown",topDown);

                img.setAttribute("deg",deg);

            },40);
  setInterval(function(){

             setTimeout(function(){

                    downAnimation();

//              },1);

            },50);
}

        /***

         * 雪花下落动画特效

         */

        function downAnimation(){

            //循环所有的雪花，改变每个雪花的落地位置

            for(var i=0;i<array.length;i++){

                var snow=array[i];

                //将处理完的删除

                array.splice(i,1);

                //校验是否已经设置完终点状态了

                if(parseInt(snow.style.top)){

                    continue;

                }

                //获取雪花与生俱来的终止状态

                var leftDown=snow.getAttribute("leftDown");

                var topDown=snow.getAttribute("topDown");

                var deg=snow.getAttribute("deg");

 

                //重新改变left和top

                snow.style.left=leftDown+"px";

                snow.style.top=topDown+"px";

 

                //重新改变雪花的角度

                snow.style.transform="rotate("+deg+"deg)";

 

                //改变透明度

                snow.style.opacity=0;

            }

 

        }