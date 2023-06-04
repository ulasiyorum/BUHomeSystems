import { getLogs } from './logger.js';

const logRoot = document.getElementById("logRoot");

var logs = getLogs();
  logs.forEach((element,index) => {
    logRoot.appendChild(`<h3 class="m-auto">${index + 1}. ${element.title} - ${element.date}</h3>`);
  });