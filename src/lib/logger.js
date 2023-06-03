export default function savelog(actionName) {

    var logs = getLogs();
    
    logs.push({title:actionName, date: new Date()});

    localStorage.setItem('logs', JSON.stringify(logs));
}

export function getLogs() {

    return JSON.parse(localStorage.getItem('logs')) || [];

}