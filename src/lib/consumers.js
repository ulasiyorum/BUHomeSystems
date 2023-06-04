import consume, { startConsuming , consumeFromId } from "./electricityConsumer.js";
import savelog from "./logger.js";
import { getCurrentUser } from "./users.js";

const toDoRoot = document.getElementById('toDoRoot');
const addToDoButton = document.getElementById('addToDoButton');

const toDoInput1 = document.getElementById("toDoInput1");
const toDoInput2 = document.getElementById("toDoInput2");

const livingRoom = document.getElementById("toggle-living");
const kitchen = document.getElementById("toggle-kitchen");
const kidsRoom = document.getElementById("toggle-kid");
const entrance = document.getElementById("toggle-entrance");
const storeroom = document.getElementById("toggle-store");
const garage = document.getElementById("toggle-garage");

const conditioner = document.getElementById("toggle-air");

livingRoom.addEventListener('change', () => {
  if (livingRoom.checked) {
    savelog("Turned on living room light:" + getCurrentUser().username);
    
    startConsuming(0.1, "livingRoom");
  } else {
    savelog("Turned off living room light:" + getCurrentUser().username);
  
    consumeFromId("livingRoom");
  }
});

kitchen.addEventListener('change', () => {
  if (kitchen.checked) {
    savelog("Turned on kitchen light:" + getCurrentUser().username);

    startConsuming(0.1, "kitchen");
  } else {
    savelog("Turned off kitchen light:" + getCurrentUser().username);

    consumeFromId("kitchen");
  }
});


kidsRoom.addEventListener('change', () => {
  if (kidsRoom.checked) {
    savelog("Turned on kids room light:" + getCurrentUser().username);

    startConsuming(0.1, "kidsRoom");
  } else {
    savelog("Turned off kids room light:" + getCurrentUser().username);

    consumeFromId("kidsRoom");
  }
});


entrance.addEventListener('change', () => {
  if (entrance.checked) {
    savelog("Turned on entrance lock:" + getCurrentUser().username);

    startConsuming(0.1, "entrance");
  } else {
    savelog("Turned off entrance lock:" + getCurrentUser().username);

    consumeFromId("entrance");
  }
});


storeroom.addEventListener('change', () => {
  if (storeroom.checked) {
    savelog("Turned on storeroom lock:" + getCurrentUser().username);

    startConsuming(0.1, "storeroom");
  } else {
    savelog("Turned off storeroom lock:" + getCurrentUser().username);

    consumeFromId("storeroom");
  }
});




garage.addEventListener('change', () => {
  if (garage.checked) {
    savelog("Turned on garage lock:" + getCurrentUser().username);

    startConsuming(0.1, "garage");
  } else {
    savelog("Turned off garage lock:" + getCurrentUser().username);

    consumeFromId("garage");
  }
});


conditioner.addEventListener('change', () => {
  if (conditioner.checked) {
    savelog("Turned on conditioner:" + getCurrentUser().username);

    startConsuming(0.5, "conditioner");

  } else {
    savelog("Turned off conditioner:" + getCurrentUser().username);

    consumeFromId("conditioner");
  }
});

function addToDo(title, description) {

  const toDos = JSON.parse(localStorage.getItem('toDos')) || [];

  toDos.push({title:title, description:description});

  const number = toDos.length;
  const data = 
  `<span id="toDoId${number}" class="m-4 d-flex flex-row justify-content-between">
    <h5 class="m-2">${number}.</h5>
    <h5 class="m-2">${title}</h5>
    <h5 class="m-2">${description}</h5>
    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
  </span>`

  toDoRoot.innerHTML += data;

  localStorage.setItem('toDos', JSON.stringify(toDos));
  const username = getCurrentUser().username;
  savelog("Added a new to do: " + username);

}

addToDoButton.addEventListener('click', () => addToDo(toDoInput1.value, toDoInput2.value));


function fetchToDos() {

  const toDos = JSON.parse(localStorage.getItem('toDos')) || [];
  toDos
  .forEach((element,index) => {

    const number = index + 1;
    const title = element.title;
    const description = element.description;
    const data = 
    `<span class="m-4 d-flex flex-row justify-content-between">
      <h5 class="m-2">${number}.</h5>
      <h5 class="m-2">${title}</h5>
      <h5 class="m-2">${description}</h5>
      <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
    </span>`

    toDoRoot.innerHTML += data;

  });
}

fetchToDos();