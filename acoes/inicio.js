const ReconhecimentoVoz = window.SpeechRecognition || window.webkitSpeechRecognition;

const comandos = {
    aluno: "pages/login.php?perfil=aluno",
    professor: "pages/login.php?perfil=professor",
    ajuda: "pages/suporte.php"
};

function listarVozes() {
    const vozes = speechSynthesis.getVoices();

    vozes.forEach((voz, indice) => {
        console.log(indice, voz.name, voz.lang);
    });
}

speechSynthesis.onvoiceschanged = listarVozes;

function falar(texto, callback) {

    const voz = new SpeechSynthesisUtterance(texto);

voz.lang = "pt-BR";
voz.rate = 1.3;
voz.pitch = 1.1;
    const vozes = speechSynthesis.getVoices();

    voz.voice = vozes.find(v =>
        v.lang === "pt-BR"
    );

    speechSynthesis.speak(voz);

    voz.onend = function () {
        if (callback) callback();
    };
}
function ouvir() {

    if (!ReconhecimentoVoz) {
        document.getElementById("resposta").innerHTML =
        "Navegador sem suporte a voz.";
        return;
    }

    falar(
"Olá! Bem-vindo à Dorina. Como deseja acessar o sistema? Diga 'aluno' ou 'professor'.",        iniciarReconhecimento
    );
}

function iniciarReconhecimento() {

    const reconhecimento = new ReconhecimentoVoz();

    reconhecimento.lang = "pt-BR";
    reconhecimento.continuous = false;
    reconhecimento.interimResults = false;

    reconhecimento.start();

    document.getElementById("resposta").innerHTML =
    "🎤 Ouvindo...";

    reconhecimento.onresult = function(event){

        let comando = event.results[0][0].transcript.toLowerCase();

        document.getElementById("resposta").innerHTML =
        "Você disse: " + comando;

        if(comando.includes("aluno")){

            falar("Abrindo aluno");

            setTimeout(()=>{
                window.location.href = comandos.aluno;
            },1000);

        } else if(comando.includes("professor")){

            falar("Abrindo professor");

            setTimeout(()=>{
                window.location.href = comandos.professor;
            },1000);

        } else if(comando.includes("ajuda") || comando.includes("suporte")){

            falar("Abrindo suporte");

            setTimeout(()=>{
                window.location.href = comandos.ajuda;
            },1000);

        } else {

falar("Não entendi. Diga aluno ou professor.");
        }
    };

    reconhecimento.onerror = function(event){

        document.getElementById("resposta").innerHTML =
        "Erro: " + event.error;

    };
}