<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="jquery/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <style type="text/css">
        [v-clock] {
            display: none
        }

        body {
            background-color:#fff;
            color: #fff;
            padding: 10px;
        }

        .box {
            height: 400px;
            width: 400px;
            margin: 200px auto;
            position: relative;
            transform: rotateX(0deg) rotateY(0deg);
            transform-style: preserve-3d;
            cursor: move;
        }

        .box div {
            position: absolute;
            left: 0;
            right: 0;
            background-size: cover;
            background-position: center;
        }

        ul {
            list-style: none;
            width: 100%;
            margin: 0;
            padding:0 0px;
        }

        ul li {
            font-size: 60px;
            width: 100%;
            margin: auto;
            color: red
        }
        .a1{
            margin: auto;
        }
        .point{
            width: 10px;
            height: 10px;
            background-color: red;
            clear: both;
        }
        img{
            margin-left: 1.2Px;
            margin-top: 1.3px;
            float:left;
            border-radius:20px;
        }
        .imgDiv{
            float: left;
            width: 100%;
            display:flow-root;
        }
    </style>
</head>

<body>
    <form class="bs-example bs-example-form" role="form" style="margin: auto;width:80%">
        <div style="width: 40%;margin: auto;float: left">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox">
                </span>
                <span class="input-group-addon" >正面字</span>
                <input type="text" class="form-control" id="preText" name="pre" value="{{ old('pre') }}"" onchange="changeText(0)">
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox">
                </span>
                <span class="input-group-addon" >左面字</span>
                <input type="text" class="form-control" id="leftText" name="left" value="{{ old('left') }}" onchange="changeText(1)">
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox">
                </span>
                <span class="input-group-addon" >右面字</span>
                <input type="text" class="form-control" id="rightText" name="right" value="{{ old('right') }}" onchange="changeText(2)">
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox">
                </span>
                <span class="input-group-addon" >后面字</span>
                <input type="text" class="form-control" id="backText" name="back" value="{{ old('back') }}" onchange="changeText(3)">
            </div>
        </div>
        <div style="width: 40%;margin-left: 20px; float: left">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox1" checked="true">
                </span>
                <span class="input-group-addon" >正面速度</span>
                <input id="preRange" min="0" max="10" type="range" name="points" onchange="rangeChange(0)" />
                <span class="input-group-addon  spanSpeed" >5</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox1" checked="true">
                </span>
                <span class="input-group-addon" >左面速度</span>
               <input id="leftRange" min="0" max="10" type="range" name="points" onchange="rangeChange(1)"/>
               <span class="input-group-addon spanSpeed" >5</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox1" checked="true">
                </span>
                <span class="input-group-addon" >右面速度</span>
                <input id="rightRange" min="0" max="10" type="range" name="points" onchange="rangeChange(2)"/>
                <span class="input-group-addon spanSpeed" >5</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" class="textCheckbox1" checked="true">
                </span>
                <span class="input-group-addon" >后面速度</span>
                <input id="backRange" min="0" max="10" type="range" name="points" onchange="rangeChange(3)"/>
                <span class="input-group-addon spanSpeed" >5</span>
            </div>
        </div>
        <div class="modal-footer" style="float: left">
            <button type="button" class="btn btn-default" data-dismiss="modal" onmousedown="yulan()">预览</button>
            <button type="button" class="btn btn-primary">确认修改</button>           
        </div>
    </form>
    <span id="app" v-cloak>
        <div class="box" :style="{width:size.x+'px',height:size.z+'px'}">
            <div id="top" :style="styleTop"></div>
            <div id="bottom" :style="styleBottom"></div>
            <div id="left" :style="styleLeft" class="m1">
                <div id="mleft" style="width: 100%;height: 100%;overflow: hidden; margin: 0" class="a1">
                    <ul class="cont1" id="leftcont1">
                        <div id="leftImgDiv" class="imgDiv"></div>
                    </ul>
                    <ul class="cont2" id="leftCont2"></ul>
                </div>
            </div>
            <div id="right" :style="styleRight" class="m1">
                <div id="mright" style="width: 100%;height: 100%;overflow: hidden; margin: 0" class="a1">
                    <ul class="cont1" id="rightcont1">
                        <div id="rightImgDiv" class="imgDiv"></div>
                    </ul>
                    <ul class="cont2" id="rightCont2"></ul>
                </div>
            </div>
            <div id="pre" :style="stylePre" class="m1">
                <div id="mpre" style="width: 100%;height: 100%;overflow: hidden; margin: 0" class="a1">
                    <ul class="cont1" id="precont1">
                        <div id="preImgDiv" class="imgDiv"></div>
                    </ul>
                    <ul class="cont2" id="preCont2"></ul>
                </div>
            </div>
            <div id="back" :style="styleBack" class="m1">
                <div id="mback" style="width: 100%;height: 100%;overflow: hidden;margin: 0" class="a1">
                    <ul class="cont1" id="backcont1">
                        <div id="backImgDiv" class="imgDiv"></div>
                    </ul>
                    <ul class="cont2" id="backCont2"></ul>
                </div>
            </div>
        </div>
    </span> 
    <canvas id="myCanvas" width="93px" height="93px" >您的浏览器不支持 HTML5 canvas 标签。</canvas>
</body>
    <!-- 生成点状文字 -->
    <script type="text/javascript">
        var time = 20;
        var interval=0;//定时器的返回值
        function yulan(){//实现预览按钮点击事件
            clearInterval(interval);

            var imgDiv=document.getElementsByClassName('imgDiv');
            for(var i=0;i<imgDiv.length;i++){
                imgDiv[i].innerHTML = "";
            }

            var cont2=document.getElementsByClassName('cont2');
            for(var i=0;i<cont2.length;i++){
                cont2[i].innerHTML = "";
            }
            var pre=document.getElementById('preText');
            var right=document.getElementById('rightText');
            var left=document.getElementById('leftText');
            var back=document.getElementById('backText');

            getDzText(pre.value, 'pre');
            getDzText(right.value, 'right');
            getDzText(left.value, 'left');
            getDzText(back.value, 'back');

            var speed=document.getElementById('preRange').value;
            copy(speed);
            interval = setInterval('myScroll('+speed+')', time);

        }

        function changeText(num){//同步改变复选框中选择的文本的值
            var textCheckbox=document.getElementsByClassName('textCheckbox');
            var idname=['preText','leftText','rightText','backText'];
            var textvalue=document.getElementById(idname[num]).value;
            if(textCheckbox[num].checked == true){
                for(var i=0;i<4;i++){
                    if(textCheckbox[i].checked==true){
                        document.getElementById(idname[i]).value=textvalue;
                    }
                }
            }
        }

        function rangeChange(num){//同步改变复选框中的速度的值
            var textCheckbox=document.getElementsByClassName('textCheckbox1');
            var idname=['preRange','leftRange','rightRange','backRange'];
            var rangevalue=document.getElementById(idname[num]).value;
            if(textCheckbox[num].checked == true){
                for(var i=0;i<4;i++){
                    if(textCheckbox[i].checked==true){
                        document.getElementById(idname[i]).value=rangevalue;
                    }
                }
            }

            var spanSpeed=document.getElementsByClassName('spanSpeed');
            for(var i=0;i<4;i++){
                spanSpeed[i].innerHTML = "";
                spanSpeed[i].innerHTML = document.getElementById(idname[i]).value;
            }

        }

        var numberX = numberY = 16;
        function getDzText(str, surface)//str：获取字符串 surface：字符串所在的面  函数作用：获取str字符串的点状字
        {
            
            var len=str.length;
            var c=document.getElementById("myCanvas");
            var ctx=c.getContext("2d");
            ctx.font="bold 75px Arial";
            ctx.fillStyle="#cc0000";
            for (var i=0;i<str.length;i++){
                ctx.clearRect(0,0,c.width,c.height);  
                ctx.fillText(str[i],9,70);
                clickCropImage(surface);
                
            }
            var backcont1=document.getElementById(surface+"cont1");
            backcont1.style.height=101*len+ "px"; 
        }
        
        function clickCropImage(surface) {
            var canvas = document.getElementById('myCanvas');
            //  获取画布大小，判断画布大小
            var canvasH = canvas.clientHeight;
            var canvasW = canvas.clientWidth;
            //  将图片等分
            var locationArr=new Array();
            for (var y = 0; y < numberX; y++) {
                for (var x = 0; x < numberY; x++) {
                    var location = {
                        'x' : x * canvasW / numberX ,
                        'y' : y * canvasH / numberY ,
                        'Dx' : x * canvasW / numberX + canvasW / numberX,
                        'Dy' : y * canvasH / numberY + canvasH / numberY,
                        'locationOption' : (x + 1).toString() + (y + 1).toString(),
                    };
                    locationArr.push(location);
                    cropImage(canvas, (x * canvasW / numberX), (y * canvasH / numberY), canvasW / numberX, canvasH / numberY,surface);
                    
                };
            };
            canvasComimgCreated = false;
            divComimgCreated = false;
        }

        function cropImage(targetCanvas, x, y, width, height,surface) {
            var targetctx = targetCanvas.getContext('2d');
            var targetctxImageData = targetctx.getImageData(x, y, width, height);
            // sx, sy, sWidth, sHeight
            var c = document.createElement('canvas');
            var ctx = c.getContext('2d');
            c.width = width;
            c.height = height;
            ctx.rect(0, 0, width, height);
            ctx.fillStyle = 'white';
            ctx.fill();
            ctx.putImageData(targetctxImageData, 0, 0);
            // imageData, dx, dy
            // 创建img 块
            var img = document.createElement('img');
            img.src = c.toDataURL('image/jpeg', 0.92);
            var imgDiv=document.getElementById(surface+"ImgDiv");
            imgDiv.appendChild(img);
        }
        
        //复制cont1至cont2
        function copy(speed){
            var cont1 = document.getElementsByClassName('cont1');
           
            (function () {
                
                var cont2 = document.getElementsByClassName('cont2');
                for(var i=0;i<cont1.length;i++){
                    if(cont1[i].style.height>200+"px"){
                        cont2[i].innerHTML = cont1[i].innerHTML;
                    }
                }   
            })();
        }
    </script>

    <!-- 字体循环滚动 -->
    <script type="text/javascript">
        var cont1 = document.getElementsByClassName('cont1');
        function myScroll(speed) {
            var mleft =  document.getElementById('mleft');
            var mright =  document.getElementById('mright');
            var mpre =  document.getElementById('mpre');
            var mback =  document.getElementById('mback');
            if(mleft.scrollTop >= cont1[0].scrollHeight) {
                mleft.scrollTop = 0;                
            }else {
                mleft.scrollTop+=speed;
            }
            if(mright.scrollTop >= cont1[1].scrollHeight) {
                mright.scrollTop = 0;               
            }else {
                mright.scrollTop+=speed;
            }
            if(mpre.scrollTop >= cont1[2].scrollHeight) {
                mpre.scrollTop = 0;             
            }else {
                mpre.scrollTop+=speed;
            }
            if(mback.scrollTop >= cont1[3].scrollHeight) {
                mback.scrollTop = 0;                
            }else {
                mback.scrollTop+=speed;
            }

        }       

    </script>

    <script src="js/vue.min.js"></script>
    <script type="text/javascript">
        let x = '100', y = '100', z = '200';
        let vm = new Vue({
            el: '#app',
            data: {
                size: {
                    x: x,
                    y: y,
                    z: z
                },
                styleLeft: {
                    backgroundImage: `url(timg.jpg)`,
                    transform: '',
                    width: '',
                    height: ''
                },
                styleRight: {
                    backgroundImage: `url(timg.jpg)`,
                    transform: ``,
                    width: '',
                    height: ''
                },
                styleTop: {
                    backgroundImage: `url(timg.jpg)`,
                    transform: ``,
                    width: '',
                    height: ''
                },
                styleBottom: {
                    backgroundImage: `url(timg.jpg)`,
                    transform: ``,
                    width: '',
                    height: ''

                },
                stylePre: {
                    backgroundImage: `url(timg.jpg)`,
                    transform: ``,
                    width: '',
                    height: ''
                },
                styleBack: {
                    backgroundImage: `url(timg.jpg)`,
                    transform: ``,
                    width: '',
                    height: ''

                }

            },
            computed: {
                preZ() {
                    return Math.floor(this.size.y / 2) + 'px'
                },
                backZ() {
                    return Math.floor(this.size.y / 2) + 'px'
                },
                leftZ() {
                    return Math.floor(this.size.y / 2) + 'px'
                },
                rightZ() {
                    return Math.floor(this.size.x - this.size.y / 2) + 'px'
                },
                topZ() {
                    return Math.floor(this.size.y / 2) + 'px'
                },
                bottomZ() {
                    return Math.floor(this.size.z - this.size.y / 2) + 'px'
                }
            },
            created() {
                this.creat()
            },
            watch: {
                size: {
                    handler() {
                        this.creat()
                    },
                    deep: true
                }
            },
            methods: {

                creat() {
                    this.styleLeft.width = this.styleRight.width = this.size.y + 'px';
                    this.styleLeft.height = this.styleRight.height = this.size.z + 'px';
                    this.styleTop.width = this.styleBottom.width = this.size.x + 'px';
                    this.styleTop.height = this.styleBottom.height = this.size.y + 'px';
                    this.stylePre.width = this.styleBack.width = this.size.x + 'px';
                    this.stylePre.height = this.styleBack.height = this.size.z + 'px';

                    this.styleLeft.transform = `rotateY(-90deg) translateZ(${this.leftZ})`;
                    this.styleRight.transform = `rotateY(90deg) translateZ(${this.rightZ})`;
                    this.styleTop.transform = `rotateX(90deg) translateZ(${this.topZ})`;
                    this.styleBottom.transform = `rotateX(-90deg) translateZ(${this.bottomZ})`;
                    this.stylePre.transform = `translateZ(${this.preZ})`;
                    this.styleBack.transform = `rotateY(180deg) translateZ(${this.backZ})`;
                }

            }
        })
    </script>
    <script src="js/jquery-touchrotate.js"></script>
    <script type="text/javascript">
        $('.box').touchrotate({
            //初始3D旋转
            rotateX: -15,
            rotateY: 15,
            //数值越小 , 旋转速度越快
            speedX: 2,
            speedY: 2,
            // 旋转的倍数, 越大旋转的圈数越多
            multipleX: 50,
            multipleY: 50,
            // 动画持续的时间, 单位是S
            time: 2,
            //模式 0:表示匀速运动 , 运动中途可以重新开始 , 1表示先加速后减速(动画过程中不可滑动,体验效果差)
            model: 0
        });
    </script>
</html>