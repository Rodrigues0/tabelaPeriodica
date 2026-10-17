<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Tabela Periódica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .tabela {
            display: grid;
            grid-template-columns: repeat(18, minmax(0, 1fr));
            grid-template-rows: repeat(7, 65px);
            gap: 4px;
        }

        .elemento {
            grid-row: var(--r);
            grid-column: var(--c);
            border: 1px solid #333;
            border: 1px solid #333;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            font-size: 11px;
            border-radius: 4px;
            user-select: none;
            transition: transform 0.1s ease, background-color 0.2s ease;
        }

        .categoria-metal-alcalino {
            background-color: #ffd6a5;
        }

        .categoria-metal-alcalino-terroso {
            background-color: #fdffb6;
        }

        .categoria-metal-de-transicao {
            background-color: #caffbf;
        }

        .categoria-metal-pos-transicao {
            background-color: #9bf6ff;
        }

        .categoria-semimetal {
            background-color: #a0c4ff;
        }

        .categoria-nao-metal {
            background-color: #bdb2ff;
        }

        .categoria-halogenio {
            background-color: #ffc6ff;
        }

        .categoria-gas-nobre {
            background-color: #ffadad;
        }

        .categoria-lantanideo {
            background-color: #d8f3dc;
        }

        .categoria-actinideo {
            background-color: #f1c0e8;
        }

        .elemento strong {
            display: block;
            font-size: 18px;
        }

        .elemento:hover {
            transform: scale(1.05);
            background-color: #e0e0e0;
        }

        .elemento strong {
            display: block;
            font-size: 18px;
            grid-row: var(--r);
            grid-column: var(--c);
        }

        /* Estilos do Modal (Janela) */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            align-items: center;
            justify-content: center;
        }

        .modal.aberta {
            display: flex;
        }

        .modal-conteudo {
            background: white;
            padding: 24px;
            border-radius: 8px;
            max-width: 420px;
            width: 90%;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        #fechar-modal {
            position: absolute;
            top: 12px;
            right: 12px;
            cursor: pointer;
            padding: 4px 8px;
        }

        .legenda {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }

        .legenda-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        .cor {
            width: 16px;
            height: 16px;
            border: 1px solid #333;
            border-radius: 3px;
        }

        .marcador {
            grid-row: var(--r);
            grid-column: var(--c);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px dashed #333;
            border-radius: 4px;
            font-size: 11px;
        }

        .elemento.apagado {
            opacity: 0.2;
        }

        .legenda-item {
            cursor: pointer;
        }

        .legenda-item.ativa {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Tabela Periódica</h1>



    <div class="tabela">
        @foreach ($elementos as $elemento)
        <div class="elemento categoria-{{ $elemento['categoria'] }}"
            style="--r: {{ $elemento['linha'] }}; --c: {{ $elemento['coluna'] }};"
            data-numero="{{ $elemento['numero'] }}"
            data-simbolo="{{ $elemento['simbolo'] }}"
            data-nome="{{ $elemento['nome'] }}"
            data-massa="{{ $elemento['massa'] }}"
            data-categoria="{{ $elemento['categoria'] }}"
            data-resumo="{{ $elemento['resumo'] }}">
            <span>{{ $elemento['numero'] }}</span>
            <strong>{{ $elemento['simbolo'] }}</strong>
            <span>{{ $elemento['nome'] }}</span>

        </div>
        @endforeach
        <div class="marcador categoria-lantanideo" style="--r: 6; --c: 3;">57–71</div>
        <div class="marcador categoria-actinideo" style="--r: 7; --c: 3;">89–103</div>
    </div>

    <div class="legenda">
        <div class="legenda-item" data-categoria="metal-alcalino"><span class="cor categoria-metal-alcalino"></span> Metal alcalino</div>
        <div class="legenda-item" data-categoria="metal-alcalino-terroso"><span class="cor categoria-metal-alcalino-terroso"></span> Metal alcalino-terroso</div>
        <div class="legenda-item" data-categoria="metal-de-transicao"><span class="cor categoria-metal-de-transicao"></span> Metal de transição</div>
        <div class="legenda-item" data-categoria="metal-pos-transicao"><span class="cor categoria-metal-pos-transicao"></span> Metal pós-transição</div>
        <div class="legenda-item" data-categoria="semimetal"><span class="cor categoria-semimetal"></span> Semimetal</div>
        <div class="legenda-item" data-categoria="nao-metal"><span class="cor categoria-nao-metal"></span> Não metal</div>
        <div class="legenda-item" data-categoria="halogenio"><span class="cor categoria-halogenio"></span> Halogênio</div>
        <div class="legenda-item" data-categoria="gas-nobre"><span class="cor categoria-gas-nobre"></span> Gás nobre</div>
        <div class="legenda-item" data-categoria="lantanideo"><span class="cor categoria-lantanideo"></span> Lantanídeo</div>
        <div class="legenda-item" data-categoria="actinideo"><span class="cor categoria-actinideo"></span> Actinídeo</div>
    </div>


    <div id="modal" class="modal">
        <div class="modal-conteudo">
            <button id="fechar-modal" type="button">X</button>
            <h2 id="modal-nome"></h2>
            <p><strong>Símbolo:</strong> <span id="modal-simbolo"></span></p>
            <p><strong>Número Atômico:</strong> <span id="modal-numero"></span></p>
            <p><strong>Massa Atômica:</strong> <span id="modal-massa"></span></p>
            <p><strong>Categoria:</strong> <span id="modal-categoria"></span></p>
            <p id="modal-resumo"></p>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modal');

        document.querySelectorAll('.elemento').forEach((el) => {
            el.addEventListener('click', () => {
                document.getElementById('modal-nome').textContent = el.dataset.nome;
                document.getElementById('modal-simbolo').textContent = el.dataset.simbolo;
                document.getElementById('modal-numero').textContent = el.dataset.numero;
                document.getElementById('modal-massa').textContent = el.dataset.massa;
                document.getElementById('modal-categoria').textContent = el.dataset.categoria;
                document.getElementById('modal-resumo').textContent = el.dataset.resumo;

                modal.classList.add('aberta');
            });
        });

        document.getElementById('fechar-modal').addEventListener('click', () => {
            modal.classList.remove('aberta');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('aberta');
            }
        });

        document.addEventListener('keydown', (evento) => {
            if (evento.key === 'Escape') {
                modal.classList.remove('aberta');
            }
        });
    </script>
</body>

</html>