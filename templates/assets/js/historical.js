const botao1 = document.getElementById('btnstatus1');
const botao2 = document.getElementById('btnstatus2');
const botao3 = document.getElementById('btnstatus3');
const botao4 = document.getElementById('btnstatus4');
const botao5 = document.getElementById('btnstatus5');
const botao6 = document.getElementById('btnstatus6');
const botao7 = document.getElementById('btnstatus7');
const botao8 = document.getElementById('btnstatus8');
const botao9 = document.getElementById('btnstatus9');

document.querySelectorAll('.status-buttons').forEach(function(group, groupIndex) {
    // Recupera do localStorage o id do botão ativo deste grupo
    const activeBtnId = localStorage.getItem('status-btn-active-' + groupIndex);
    if (activeBtnId) {
        const btn = group.querySelector('#' + activeBtnId);
        if (btn) btn.classList.add('active');
    }

    group.querySelectorAll('.status-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Remove active de todos do grupo
            group.querySelectorAll('.status-btn').forEach(function(b) {
                b.classList.remove('active');
            });
            // Adiciona active ao clicado
            btn.classList.add('active');
            // Salva no localStorage o id do botão ativo deste grupo
            localStorage.setItem('status-btn-active-' + groupIndex, btn.id);
        });
    });
});