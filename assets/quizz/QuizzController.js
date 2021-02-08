import { QuizzModel } from './QuizzModel.js';
import { QuizzView } from './QuizzView.js';

export class QuizzController
{
    constructor()
    {
        this.model = new QuizzModel();
        this.view  = new QuizzView();
    }

    /**
     * Start the app
     */
    start()
    {
        this.view.bindOnClickChoice(this.handleClickChoice);
        this.view.bindOnClickNext(this.handleClickNext);
        this.model.getManifest((manifest) => {
            this.view.manifest = manifest;
        });
    }

    /**
     * Handle click on a choice button
     *
     * @param {Event} event The view event
     */
    handleClickChoice = (event) => {
        this.model.checkChoice(this.view.renderResult, event.target.value);
    }

    /**
     * Handle click on the next button
     *
     * @param {Event} event The view event
     */
    handleClickNext = (event) => {
        event.preventDefault();
        this.model.getNextSpecies(this.onQuizzNextReceived);
        // this.model.checkChoice(this.view.displayResult, choice);
    }



    onQuizzNextReceived = (quizzData) => {
        if (quizzData.end) {
            // quizz finished
            this.view.renderQuizzEnd(quizzData);
            return ;
        }

        this.view.renderQuizz(quizzData);
    }
}
