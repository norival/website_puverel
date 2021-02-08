export class QuizzView
{
    constructor()
    {
        this.quizz        = document.getElementById('quizz');
        this.quizzPicture = document.getElementById('quizz-picture');
        this.quizzChoices = document.getElementById('quizz-choices');

        this.quizzChoices.addEventListener('click', (event) => {
            if (event.target.value) {
                event.preventDefault();
                this.onClickChoice(event);
            }
        });
    }

    bindOnClickChoice(handler)
    {
        this.onClickChoice = handler;
    }
    bindOnClickNext(handler)
    {
        this.onClickNext = handler;
    }

    renderResult = (result) => {
        console.log(result);

        let tpl = `
            <h2>Bravo !</h2>
            <p>Tu as réussi ! C'était le ${result.choice.commonName}.</p>
        `;

        if (!result.result) {
            tpl = `
                <h2>Loupé !</h2>
                <p>La bonne réponse était ${result.goodSpecies.commonName} et non ${result.choice.commonName}.</p>
                <p>${result.goodSpecies.description}</p>
                <img src="${this.manifest[result.goodSpecies.filePath]}" alt="">
            `
        }

        tpl += `
            <ul class="buttonList">
                <li>
                    <a id="quizz-next" href="/quizz/feuillus/5?next">Suivant</a>
                </li>
            </ul>
        `;

        this.quizz.innerHTML = tpl;

        document.getElementById('quizz-next').addEventListener('click', this.onClickNext);
    }

    /**
     * Render the quizz
     *
     * @param {turn: int, nSpecies: int, species: [], choices: [], nTurns: int}
     *  quizzData The data for the current turn
     * @returns {undefined}
     */
    renderQuizz = (quizzData) => {
        console.log(quizzData);
        let listItems = '';
        quizzData.choices.forEach(choice => {
            listItems += `
                <div class="col-12 col-md-6 col-lg-3 mt-4">
                    <button name="choice" type="submit" value="${choice.id}">
                        ${choice.commonName}
                    </button>
                </div>
            `;
        });

        const tpl = `
            <h2>Feuille ${quizzData.currentTurn} / ${quizzData.nTurns}</h2>
            <img id="quizz-picture" src="${this.manifest[quizzData.currentSpecies.filePath]}" alt="">
            <form action="/quizz/feuillus/${quizzData.nSpecies}/result" method="POST">
                <div id="quizz-choices">
                    <div class="row">
                        ${listItems}
                    </div>
                </div>
            </form>
        `;

        this.quizz.innerHTML = tpl;

        this.quizzPicture = document.getElementById('quizz-picture');
        this.quizzChoices = document.getElementById('quizz-choices');

        this.quizzChoices.addEventListener('click', (event) => {
            if (event.target.value) {
                event.preventDefault();
                this.onClickChoice(event);
            }
        });
    }

    renderQuizzEnd = (quizzData) => {
        let listItems = '';
        quizzData.speciesList.forEach(species => {
            listItems += `
                <li>
                    <h3>${species.common_name}</h3>
                    <img src="${this.manifest[species.file_name]}" alt="">
                    <p class="description">
                        ${species.description}
                    </p>
                </li>
            `;
        });

        const tpl = `
            <div id="result">
                <h2>Le quizz est terminé !</h2>
                <div class="score">${quizzData.score} / ${quizzData.nTurns}</div>
                <p>Il y avait ces ${quizzData.nSpecies} espèces :</p>
                <ul class="speciesList">
                    ${listItems}
                </ul>
            </div>
        `;

        this.quizz.innerHTML = tpl;
    }
}
