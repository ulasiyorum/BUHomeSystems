import getCurrentUser from './getCurrentUser.js';
import { getLogs } from './logger.js';

const logRoot = document.getElementById("logRoot");
const goToConsumer = document.getElementById("goToConsumer");


goToConsumer.addEventListener('click', () => {
    window.location.href = "consumer_main.html";
  });

var logs = getLogs();
  logs.forEach((element,index) => {
    logRoot.innerHTML += `<h5 class="m-4">${index + 1}. ${element.title} - ${new Date(element.date).toLocaleDateString('tr-TR')}</h5>`;
  });