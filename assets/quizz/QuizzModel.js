export class QuizzModel
{
    constructor(nSpecies)
    {
        this.nSpecies = nSpecies;
    }


    checkChoice(callback, choice)
    {
        fetch(`/api/quizz/${this.nSpecies}/result`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                choice
            })
        })
            .then(response => response.json())
            .then(resultData => callback(resultData));
    }

    getNextSpecies(callback)
    {
        fetch(`/api/quizz/${this.nSpecies}/next`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => callback(data.quizz));
    }

    getManifest(callback)
    {
        fetch('/build/manifest.json')
            .then(response => response.json())
            .then(data => callback(data));
    }
}
