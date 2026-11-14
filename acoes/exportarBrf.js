function converterTextoParaBrf(texto) {
    const substituicoes = {
        "“": '"',
        "”": '"',
        "‘": "'",
        "’": "'",
        "–": "-",
        "—": "-",
        "…": "...",
        "•": "*",
        "\u00a0": " "
    };
    const digitosEmBraille = {
        "1": "A",
        "2": "B",
        "3": "C",
        "4": "D",
        "5": "E",
        "6": "F",
        "7": "G",
        "8": "H",
        "9": "I",
        "0": "J"
    };
    const textoNormalizado = Array.from(String(texto ?? ""))
        .map(caractere => substituicoes[caractere] || caractere)
        .join("")
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
    let numeroAtivo = false;
    let resultado = "";

    for (const caractere of textoNormalizado) {
        if (/\s/.test(caractere)) {
            resultado += caractere === "\n" || caractere === "\r" ? caractere : " ";
            numeroAtivo = false;
        } else if (/\d/.test(caractere)) {
            if (!numeroAtivo) {
                resultado += "#";
                numeroAtivo = true;
            }
            resultado += digitosEmBraille[caractere];
        } else if (/[a-z]/i.test(caractere)) {
            numeroAtivo = false;
            if (caractere !== caractere.toLocaleLowerCase("pt-BR")) {
                resultado += ",";
            }
            resultado += caractere.toLocaleUpperCase("pt-BR");
        } else if (/^[\x20-\x5f]$/.test(caractere)) {
            numeroAtivo = false;
            resultado += caractere;
        } else {
            throw new Error(`O caractere "${caractere}" não pode ser convertido para Braille ASCII.`);
        }
    }

    return resultado;
}

function exportarAtividadeBrf(atividade) {
    const conteudo = [
        `TITULO: ${atividade.titulo || ""}`,
        `MATERIA: ${atividade.materia || ""}`,
        "",
        "DESCRICAO:",
        atividade.descricao || ""
    ].join("\n");
    const brf = converterTextoParaBrf(conteudo);
    const nomeBase = String(atividade.titulo || `atividade-${atividade.id_atividade || ""}`)
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .toLocaleLowerCase("pt-BR")
        .replace(/[^a-z0-9]+/g, "-")
        .replace(/^-|-$/g, "") || "atividade";
    const arquivo = new Blob([brf], { type: "text/plain;charset=us-ascii" });
    const url = URL.createObjectURL(arquivo);
    const link = document.createElement("a");

    link.href = url;
    link.download = `${nomeBase}.brf`;
    link.click();
    URL.revokeObjectURL(url);
}
