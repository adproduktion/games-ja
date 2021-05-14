let map = document.getElementById("game-zone");
var ctx = map.getContext("2d");
let Name;
var date = new Date(); //дата
let rubbishShard = []; //масив с маленьким мусором
let rubbishBig = []; //массив с большим мусором
let Ray = []; //массив с лучами
let ray = 0; //если ноль то луча нет, если 1 то он есть
let rayTik = 0; //это кд луча стои ноль, потомучто заполняется, когда луч прекратил действовать 
let rayTime = 5; //это время действия луча
let timerint = 0; //тут будет храниться таймер для он вызывает мусор и еще что то, а кд луча и его время действия
let timerstep = 0; // тут
let irubbishShard = 0; //i для маленького мусора
let irubbishBig = 0;//i для большого мусора
let gamepause = false; //пайза если false то игра идет, иначе стоит
let Delete = { //тут хранися собранный мусор
    shard: 0,
    big: 0
}

let step = { //это вроде чтобы определитькуда ходит мусор
    x: 0,
    y: 0
};

map.width = 1920;
map.height = 1080;

let time = { //это секунды
    s: 0
};

function getRandomIntInclusive(min, max) { //создание рандомных чисел 
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min; //Максимум и минимум включаются
}


const rayImg = new Image(); // луч
rayImg.src = "assets/images/pattern-space.png";
function createRay(i) { //Создание луча 
    Ray[i] = {
        y: ((map.height - 115) - 28) - (28*i),
        width: 28,
        height: 28,
    };
}; 
function vizovRay() { //создания лучей (луча) создаем их 35 штук
    for (let i = 0; i < 35; i++){
    createRay(i);
    }
}
vizovRay();

document.addEventListener("keydown", RayActive);//Это луч по пробелу
function RayActive(event) {
    if(gamepause == false){
        if(rayTik == 2) {
            if (event.keyCode == 32) {
                ray=1;
            }
        }
    }
};



const playerImg = new Image(); // герой
playerImg.src = "assets/images/player.png";
let Player = {
    x: (map.width/2) - 25,
    y: map.height - 115,
    width: 50,
    height: 115,
};


const groundImg = new Image(); // карта
groundImg.src = "assets/images/bg.jpeg";
let ground = {
    x: 0,
    y: 0,
};

let rubbishBigImg = new Image(); //большой мусор
rubbishBigImg.src = "assets/images/garbage-2.png";
function createRubbishBig(i, Xspeed, Yspeed) { //Создание большого мусора
    rubbishBig[i] = {
        x: getRandomIntInclusive(1, 1860),
        y: getRandomIntInclusive(1, 1000),
        width: 100,
        height: 100,
        speedX: Xspeed,
        speedY: Yspeed,
    };
}; 
function vizovRubbishBig(b) { //Создание большого мусора и вобор его движения
    for (let i = b; i< b+3; i++){
    if (getRandomIntInclusive(0, 1) == 0)
    {
        step.x = getRandomIntInclusive(2, 7);
    }
    else{
        step.x = getRandomIntInclusive(-7, -2);
    }
    if (getRandomIntInclusive(0, 1) == 0)
    {
        step.y = getRandomIntInclusive(2, 7);
    }
    else{
        step.y = getRandomIntInclusive(-7, -2);
    }
    createRubbishBig(i, step.x, step.y);
    irubbishBig++;
    }
}
function vizovBig() {
    vizovRubbishBig(irubbishBig);
}
let rubbishShardImg = new Image(); //Мусор
rubbishShardImg.src = "assets/images/garbage-1.png";
function createrubbishShard(i,  Xspeed, Yspeed) { //Создания мусора
    rubbishShard[i] = {
        x: getRandomIntInclusive(1, 1860),
        y: getRandomIntInclusive(1, 1000),
        width: 25,
        height: 25,
        speedX: Xspeed,
        speedY: Yspeed,
    };
}; 
function vizovrubbishShard(b) { //Создания мусора и выбор направления его движения 
    for (let i = b; i< b+1; i++){
    
    if (getRandomIntInclusive(0, 1) == 0)
    {
        step.x = getRandomIntInclusive(2, 7);
    }
    else{
        step.x = getRandomIntInclusive(-7, -2);
    }
    if (getRandomIntInclusive(0, 1) == 0)
    {
        step.y = getRandomIntInclusive(2, 7);
    }
    else{
        step.y = getRandomIntInclusive(-7, -2);
    }
    createrubbishShard(i, step.x, step.y);
    irubbishShard++;
    }
}
function vizov() {
    vizovrubbishShard(irubbishShard);
}
function stepRubbish() { //это шаги мусора

    for (let i = 0; i < rubbishShard.length; i++) {
        rubbishShard[i].x = rubbishShard[i].x + rubbishShard[i].speedX;
        rubbishShard[i].y = rubbishShard[i].y + rubbishShard[i].speedY;
    }
    for (let i = 0; i < rubbishBig.length; i++) {
        rubbishBig[i].x = rubbishBig[i].x + rubbishBig[i].speedX;
        rubbishBig[i].y = rubbishBig[i].y + rubbishBig[i].speedY;
    }
}

document.addEventListener("keydown", movePlayer); //движение ероя
function movePlayer(event) {
    if(Player.x > 16) {
        if (event.keyCode == 37) {
            if (gamepause == false) {
                Player.x -= 15;
            }
        }
    }
    if(Player.x < (map.width - 60)){
        if (event.keyCode == 39) {
            if (gamepause == false) {
                Player.x += 15;
            }
        }
    }
};

document.addEventListener("keydown", Pauseds); //пауза по Esc
function Pauseds(event) {
    if(event.keyCode == 27) { 
        if (gamepause == false) {
            gamepause = true;
        }
        else{
            gamepause = false;
        }
        Paused();
    }
};
function seconds() {
    time.s++;
        vizov();//создаем маленький мусор
    if(time.s%4 == 0){//
        vizovBig();//создаем большой мусор
    }
    
    if(ray==0){   //Перезарядка луча
        if(rayTik < 2){
            rayTik++;
        }            
    }
    if(ray==1){//время действия луча
        if (rayTime>0)
        {   
            rayTime--;
        }
        if(rayTime == 0){
            ray=0;
            rayTime=5;
            rayTik = 0;
        }
    }

}

function checkShard(i) { //Проверка касания
    for(j =0; j<Ray.length; j++){
        if (rubbishShard[i].x >= (Player.x + 11) && rubbishShard[i].x <= (Player.x + 11) + Ray[j].width && rubbishShard[i].y >= Ray[j].y && rubbishShard[i].y <= Ray[j].y + Ray[j].height || rubbishShard[i].x + rubbishShard.width >= (Player.x + 11) && rubbishShard[i].x <= (Player.x + 11) + Ray[j].width && rubbishShard[i].y >= Ray[j].y && rubbishShard[i].y <= Ray[j].y + Ray[j].height || rubbishShard[i].x + rubbishShard.width >= (Player.x + 11) && rubbishShard[i].x <= (Player.x + 11) + Ray[j].width && rubbishShard[i].y + rubbishShard.height >= Ray[j].y && rubbishShard[i].y <= Ray[j].y + Ray[j].height) {
            if (ray == 1){
                rubbishShard[i].x = -99999; 
                Delete.shard++;
            }  
        }
    }   
}
function checkBig(i) { //Проверка касания
    for(j =0; j<Ray.length; j++){
        if (rubbishBig[i].x >= (Player.x + 11) && rubbishBig[i].x <= (Player.x + 11) + Ray[j].width && rubbishBig[i].y >= Ray[j].y && rubbishBig[i].y <= Ray[j].y + Ray[j].height || rubbishBig[i].x + rubbishBig.width >= (Player.x + 11) && rubbishBig[i].x <= (Player.x + 11) + Ray[j].width && rubbishBig[i].y >= Ray[j].y && rubbishBig[i].y <= Ray[j].y + Ray[j].height || rubbishBig[i].x + rubbishBig.width >= (Player.x + 11) && rubbishBig[i].x <= (Player.x + 11) + Ray[j].width && rubbishBig[i].y + rubbishBig.height >= Ray[j].y && rubbishBig[i].y <= Ray[j].y + Ray[j].height) {
            if (ray == 1){
                rubbishBig[i].x = -99999; 
                Delete.big++;
            }    
        }
    }   
}
function EndGame() { //конец игры, думаю тут все понятно
    if((Delete.big +  Delete.shard)>=10){
        gamepause = true;
        Paused();
        document.getElementById("screen-game").style.display = "none";
        document.getElementById("screen-results").style.display = "flex"; 
        document.getElementById('ShardRezults').innerHTML = rubbishShard.length + rubbishBig.length;
        document.getElementById('deleteShardRezults').innerHTML = Delete.big + Delete.shard; 
        if((Delete.big + Delete.shard) > (rubbishShard.length + rubbishBig.length)/2){
            document.getElementById("alert-success").style.display = "block"; 
        }
        else{
            document.getElementById("alert-danger").style.display = "block"; 
        }
    }
}




let draw = function() {
    EndGame();
    date = new Date();
    document.getElementById('date-dmy').innerHTML = date.getDate()+"."+ "0"+(date.getMonth()+1)+"."+date.getFullYear();//рисуем дату
    document.getElementById('date-hms').innerHTML = date.getHours()-1+"."+ date.getMinutes()+"."+date.getSeconds();//рисуем время
    document.getElementById('Shard').innerHTML = rubbishShard.length + rubbishBig.length; //рисуем сколлько мусора заспавнилось
    document.getElementById('deleteShard').innerHTML = Delete.big + Delete.shard;//рисуем сколлько мусора собрали

    ctx.drawImage(groundImg, ground.x, ground.y, map.width, map.height); //вывод фона
    
    for (let i = 0; i < rubbishShard.length; i++) {
        ctx.drawImage(rubbishShardImg, rubbishShard[i].x, rubbishShard[i].y, rubbishShard[i].width, rubbishShard[i].height); //рисуем мусор маленький
        checkShard(i); //проверка на качание
        
    };
    for (let i = 0; i < rubbishBig.length; i++) {
        ctx.drawImage(rubbishBigImg, rubbishBig[i].x, rubbishBig[i].y, rubbishBig[i].width, rubbishBig[i].height); //рисуем мусор большой
        checkBig(i); //проверка на качание
    };
    document.getElementById('name').innerHTML = Name;//рисуем имя
    if (ray == 1){
        for (let i = 0; i < Ray.length; i++) {
            ctx.drawImage(rayImg, Player.x + 11, Ray[i].y, Ray[i].width, Ray[i].height); //рисуем лучи (луч)
        };
    }
    ctx.drawImage(playerImg, Player.x, Player.y, Player.width, Player.height);//рисуем героя

};

let main = function() {
    draw();
    requestAnimationFrame(main);
};

function Paused() { //проверка паузы, ставит игру на паузу или возобновляет
    if (gamepause == false) {
        timerint = setInterval(seconds, 1000); //вызывает тайме каждую секунду
        timerstep = setInterval(stepRubbish, 100);//Движение монсторов каждую 1/10 секунды

    } else {
        clearInterval(timerint);//очистка интервалов
        clearInterval(timerstep);
    }
}

document.addEventListener("keydown", Start); //пауза
function Start(event) {
    if(event.keyCode == 13) {
        document.getElementById("screen-login").style.display = "none";
        document.getElementById("screen-game").style.display = "block";
        main();
        Name = document.getElementById("password").Value; //будет пароль, но сейчас имя которое беретсЯ из инпута 
        Paused();
    }
};
