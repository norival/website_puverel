import './styles/quizz.scss';
import { QuizzController } from './quizz/QuizzController';

document.addEventListener('DOMContentLoaded', () => {
    const quizzController = new QuizzController();
    quizzController.start();
});
