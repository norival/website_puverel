export class QuizzModel
{
    checkChoice(callback, choice)
    {
        console.log(choice);
        fetch('/api/quizz/5/result', {
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
        fetch('/api/quizz/5/next', {
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
