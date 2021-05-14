let map = document.getElementById("game-zone");
var ctx = map.getContext("2d");
let hp = 4; // жизни
const speed = 36;
const time_speeds= (1920/speed)*100;
let Grounds = [];
let iGround = 0;
var timerHTML = "0:0";
let Traps = [];
let iTraps = 0;
let angry = 0;
let angryTik = 0;
let angryTime = 4;
let gamepause = false;
let timerint = 0;
let timerstep = 0;







function getRandomIntInclusive(min, max) { //создание рандомных чисел 
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min; //Максимум и минимум включаются
}

let time = {
    s: 0,
    m: 0,
    point: 0,
    sa: 0,
    ma: 0
};

map.width = 1920;
map.height = 1080;

let carImg = new Image(); //Машина
carImg.src = "assets/images/car.png";

let car = {
    name: "",
    x: -200,
    y: (map.height / 2),
    width: 200,
    height: 100
};

const groundImg = new Image(); // карта
groundImg.src = "assets/images/bg.jpg";


let ground = {
    x: 0,
    y: 0,
};




let trapImg = new Image(); //Кусты
trapImg.src = "assets/images/block.png";
function createTraps(i) { //Создание лКустов
    Traps[i] = {
        x: map.width,
        y: ((map.height / 2) - 180) + (getRandomIntInclusive(0, 3) * 100),
        width: 60,
        height: 60,
    };
}; 
function vizovTraps(b) { //вызов куство и создание их координат
    for (let i = b; i< b+1; i++){
    yTraps = getRandomIntInclusive(0, 3);
    createTraps(i);
    }
    iTraps++;
}
function vizov() {
    vizovTraps(iTraps);
}

function checkCar(i) { //Проверка касания
    if (Traps[i].x >= car.x && Traps[i].x <= car.x + car.width && Traps[i].y >= car.y && Traps[i].y <= car.y + car.height || Traps[i].x + Traps.width >= car.x && Traps[i].x <= car.x + car.width && Traps[i].y >= car.y && Traps[i].y <= car.y + car.height || Traps[i].x + Traps.width >= car.x && Traps[i].x <= car.x + car.width && Traps[i].y + Traps.height >= car.y && Traps[i].y <= car.y + car.height) {
        Traps[i].x = -99999;
        if(angry == 0){
            hp = hp - 1; //ОТнимается хп при касании
        }  
        if(hp == 0){ //конец игры
            gamepause = true;
            document.getElementById("screen-game").style.display = "none";
            document.getElementById("screen-results").style.display = "flex";
            
            document.getElementById('time-rezults').innerHTML = timerHTML;//время игры
            document.getElementById('time-rezults-angry').innerHTML = timerHTMLangry;//время в ярости
            let lastTime = localStorage.getItem('time'); //загружаем предыдущий результат
            if(lastTime){//если есть
                let lastPoint = localStorage.getItem('point'); //очки прошлого игрока
                document.getElementById('time-rezults-last').innerHTML = lastTime;// предыдущий результат
                localStorage.setItem('time', timerHTML);
                if(lastPoint<time.point){
                    document.getElementById("alert-success").style.display = "block";//победа
                    localStorage.setItem('point', time.point);
                }
                else{
                    document.getElementById("alert-danger").style.display = "block";//поражение
                    localStorage.setItem('point', time.point);
                }
                
            }
            else{
                document.getElementById('time-rezults-angry').innerHTML = "00:00";
                
                document.getElementById('time-rezults-last').innerHTML = "00:00";
                localStorage.setItem('time', timerHTML);
                document.getElementById("alert-success").style.display = "block";
                localStorage.setItem('point', time.point);
            }
        }      
    }
}



function createGrounds(i) { //Создание фона
    Grounds[i] = {
        x: map.width,
        y: 0,
    };
    iGround ++;
}; 
function vizovGround() {
    createGrounds(iGround);
};

setInterval(vizovGround, time_speeds); //Создание фона каждые x секунд 

function mapSpeed() {
    ground.x -= speed;
    for (let i = 0; i < Grounds.length; i++) {
        Grounds[i].x -= speed;
    }
    for (let i = 0; i < Traps.length; i++) {
        Traps[i].x -= speed;
    }


}; //Скорость движения фона


document.addEventListener("keydown", angryCar);//Режим ярости
function angryCar(event) {
    if(angryTik == 5) {
        if (event.keyCode == 32) {
            angry=1;
        }
    }
};

document.addEventListener("keydown", moveCar); //движение машины
function moveCar(event) {
    if(car.y > (map.height / 2 - 200)) {
        if (event.keyCode == 87) {
            if (gamepause == false) {
                car.y -= 100;
            }
        }
    }
    if(car.y < (map.height / 2 + 100)){
        if (event.keyCode == 83) {
            if (gamepause == false) {
                car.y += 100;
            }
        }
    }
};

document.addEventListener("keydown", Paused); //пауза
function Paused(event) {
    if(event.keyCode == 27) {
        
        if (gamepause == false) {
            gamepause = true;
        }
        else{
            gamepause = false;
        }
        porverkapaused();
    }
};


function seconds() {
    time.s++;
    time.point++;
    if(time.s%2 == 0){//вызов кустов каждыке 2 секунды
        vizov();
    }
    if (time.s == 60) {//таймер
        time.s = 0;
        time.m++;
        
    }
    if(angry==0 && angryTime==4)//перезарядка ярости
        {   
            if(angryTik < 5){
                angryTik++;
            }            
        }
    if(angry==1){//время действия ярости
        if (angryTime>0)
        {   time.sa++;
            if(time.sa == 60) //Ощее время проведенное в ярости
            {
                time.sa = 0;
                time.ma++;
            }
            angryTime--;
            
        }
        if(angryTime == 0){
            angry=0;
            angryTime=4;
            angryTik = 0;
        }
    }
    timerHTML= time.m + ":"+ time.s; //время которое выводим
    timerHTMLangry= time.ma + ":"+ time.sa;//время в ярости которое выводим в результат
    
}



let draw = function() {

    ctx.drawImage(groundImg, ground.x, ground.y, map.width, map.height); //вывод первого фона
    for (let i = 0; i < Grounds.length; i++) {
            ctx.drawImage(groundImg, Grounds[i].x, Grounds[i].y, map.width, map.height); //вывод фонов
        };
        for (let i = 0; i < Traps.length; i++) {
            ctx.drawImage(trapImg, Traps[i].x, Traps[i].y, Traps[i].width, Traps[i].height); //вывод кустов
            checkCar(i);
        };
    ctx.drawImage(carImg, car.x, car.y, car.width, car.height); //вывод машины
    document.getElementById('heart').innerHTML = hp; //вывод жизней
    document.getElementById('timer').innerHTML = timerHTML; //Вывод таймера
    document.getElementById('car').innerHTML = car.name;
    if(angry == 1){//графическое изображение ярости
        document.getElementById('game-zone-angry').style.display = 'block';
    }
    else {
        document.getElementById('game-zone-angry').style.display = 'none';
    }
    
};


let main = function() {
    draw();
    requestAnimationFrame(main);
    if (car.x > 200){
        clearInterval(speedcar);
    }
    
};



function porverkapaused() {
    if (gamepause == false) {
        timerint = setInterval(seconds, 1000); //таймер;
        timerstep = setInterval(mapSpeed, 100); //Движение фона

    } else {
        clearInterval(timerint);
        clearInterval(timerstep);

    }
}

function getСar(cars) { //Выбор машины
    
    document.getElementById("game-start").disabled = false;;
    if (cars.id == "car1") {
        cars.style.cssText = "filter: drop-shadow(0 0 20px white)";
        document.getElementById("car2").style.cssText = "filter: none";
        document.getElementById("car3").style.cssText = "filter: none";
        car.name = "Car 1";
        carImg.src = "assets/images/car.png";


    }
    if (cars.id == "car2") {
       cars.style.cssText = "filter: drop-shadow(0 0 20px white)";
       document.getElementById("car1").style.cssText = "filter: none";
       document.getElementById("car3").style.cssText = "filter: none";
       car.name = "Car 2";
       carImg.src = "assets/images/car2.png";

    }
    if (cars.id == "car3") {
        cars.style.cssText = "filter: drop-shadow(0 0 20px white)";
        document.getElementById("car2").style.cssText = "filter: none";
        document.getElementById("car1").style.cssText = "filter: none";
        car.name = "Car 3";
        car.width = 160;
        carImg.src = "assets/images/car3.png";

    }
}

function carSpeed(){
    car.x +=7;
}
let speedcar = 0;
function t() {//Клик по кнопке старт игры
    if (car.x < 200){
        speedcar = setInterval(carSpeed, 100);
    }
    createGrounds(iGround);
    document.getElementById("screen-login").style.display = "none";
    document.getElementById("screen-game").style.display = "block";
    main();
    porverkapaused();
}
function Restart(){//Рестарт
    location.reload();
}

