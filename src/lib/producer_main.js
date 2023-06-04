import getCurrentUser from './getCurrentUser.js';
import { getLogs } from './logger.js';

const logRoot = document.getElementById("logRoot");
const goToConsumer = document.getElementById("goToConsumer");


goToConsumer.addEventListener('click', () => {
    window.location.href = "consumer_main.html";
  });

var logs = getLogs();
  logs.forEach((element,index) => {

    const title = element.title;
    const titleSplit = title.split(":");
    const username = titleSplit[1];
    const data = titleSplit[0];

    const random = Math.floor(Math.random() * 2);
    const id = random == 0 ? 'Ulas' : 'Berkay';
    const actualUsername = username == 'undefined' ? id : username;

    const actualTitle = data + ":" + actualUsername;

    logRoot.innerHTML += `<h5 class="m-4">${index + 1}. ${actualTitle} - ${new Date(element.date).toLocaleDateString('tr-TR')}</h5>`;
  });