export class QuizzView
{
    constructor()
    {
        this.quizz        = document.getElementById('quizz');
        this.quizzPicture = document.querySelector('#quizz-picture img');
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
        const goodButton = document.querySelector(`button[value="${result.goodSpecies.id}"]`);
        const nextButton = document.getElementById('next-button');

        goodButton.classList.add('quizzGoodSpecies');

        if (!result.result) {
            const badButton    = document.querySelector(`button[value="${result.choice.id}"]`);
            const badImageDiv  = document.getElementById('wrong-answer');
            const goodImageDiv = document.getElementById('quizz-picture');
            const badImage     = badImageDiv.querySelector('img');

            badButton.classList.add('quizzBadSpecies');
            badImageDiv.classList.remove('d-none');
            badImageDiv.classList.add('quizzBadSpecies');
            badImage.setAttribute('src', this.manifest[result.choice.file_path]);

            goodImageDiv.classList.remove('col-12');
            goodImageDiv.classList.add('col-6');
        }

        this.quizzChoices.querySelectorAll('button')
            .forEach(button => button.setAttribute('disabled', true));
    }

    /**
     * Render the quizz
     *
     * @param {turn: int, n_species: int, species: [], choices: [], n_turns: int}
     *  quizzData The data for the current turn
     * @returns {undefined}
     */
    renderQuizz = (quizzData) => {
        let listItems = '';
        quizzData.choices.forEach(choice => {
            listItems += `
                <div class="col-12 col-md-6 col-lg-3 mt-4">
                    <button class="button" name="choice" type="submit" value="${choice.id}">
                        ${choice.common_name}
                    </button>
                </div>
            `;
        });

        const tpl = `
            <h2>Feuille ${quizzData.current_turn} / ${quizzData.n_turns}</h2>
            <div class="row">
                <div class="col-12">
                    <img
                        id="quizz-picture"
                        src="${this.manifest[quizzData.currentSpecies.file_path]}"
                        alt="Image de la feuille">
                </div>
                <div class="col-12 d-none" id="wrong-answer">
                    <img src="#" alt="">
                </div>
            </div>
            <form action="/quizz/feuillus/${quizzData.n_species}/result" method="POST">
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

        const flags = new Set();
        const speciesListUnique = quizzData.species_list.filter(entry => {
            if (flags.has(entry.id)) {
                return false;
            }

            flags.add(entry.id);
            return true;
        });
        // console.log(speciesListUnique);

        speciesListUnique.forEach(species => {
        // for (const species of quizzData.speciesListUnique) {
            // console.log(species);
            listItems += `
                <li>
                    <h3>${species.common_name}</h3>
                    <img src="${this.manifest[species.file_path]}" alt="">
                    <p class="description">
                        ${species.description ?? '<em>Aucune description</em>'}
                    </p>
                </li>
            `;
        });

        const tpl = `
            <div id="result">
                <h2>Le quizz est terminé !</h2>
                <div class="score">${quizzData.score} / ${quizzData.n_turns}</div>
                <p>Il y avait ces ${quizzData.n_species} espèces :</p>
                <ul class="speciesList">
                    ${listItems}
                </ul>
            </div>
        `;

        this.quizz.innerHTML = tpl;
    }
}
