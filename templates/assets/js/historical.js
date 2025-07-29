const botao1 = document.getElementById('btnstatus1');
const botao2 = document.getElementById('btnstatus2');
const botao3 = document.getElementById('btnstatus3');
const botao4 = document.getElementById('btnstatus4');
const botao5 = document.getElementById('btnstatus5');
const botao6 = document.getElementById('btnstatus6');
const botao7 = document.getElementById('btnstatus7');
const botao8 = document.getElementById('btnstatus8');
const botao9 = document.getElementById('btnstatus9');

botao1.addEventListener('click',()=>{
    botao1.style.backgroundColor = 'green';
    botao2.style.backgroundColor = '#8A2BE2';
    botao3.style.backgroundColor = '#8A2BE2';
})
botao2.addEventListener('click',()=>{
    botao2.style.backgroundColor = 'red';
    botao1.style.backgroundColor = '#8A2BE2';
    botao3.style.backgroundColor = '#8A2BE2';
})
botao3.addEventListener('click',()=>{
    botao3.style.backgroundColor = 'darkgoldenrod';
    botao2.style.backgroundColor = '#8A2BE2';
    botao1.style.backgroundColor = '#8A2BE2';
})

botao4.addEventListener('click',()=>{
    botao4.style.backgroundColor = 'green';
    botao5.style.backgroundColor = '#8A2BE2';
    botao6.style.backgroundColor = '#8A2BE2';
})
botao5.addEventListener('click',()=>{
    botao5.style.backgroundColor = 'red';
    botao4.style.backgroundColor = '#8A2BE2';
    botao6.style.backgroundColor = '#8A2BE2';
})
botao6.addEventListener('click',()=>{
    botao6.style.backgroundColor = 'darkgoldenrod';
    botao5.style.backgroundColor = '#8A2BE2';
    botao4.style.backgroundColor = '#8A2BE2';
})

botao7.addEventListener('click',()=>{
    botao7.style.backgroundColor = 'green';
    botao8.style.backgroundColor = '#8A2BE2';
    botao9.style.backgroundColor = '#8A2BE2';
})
botao8.addEventListener('click',()=>{
    botao8.style.backgroundColor = 'red';
    botao7.style.backgroundColor = '#8A2BE2';
    botao9.style.backgroundColor = '#8A2BE2';
})
botao9.addEventListener('click',()=>{
    botao9.style.backgroundColor = 'darkgoldenrod';
    botao8.style.backgroundColor = '#8A2BE2';
    botao7.style.backgroundColor = '#8A2BE2';
})