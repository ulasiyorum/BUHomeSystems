import consume, { startConsuming , consumeFromId } from "./electricityConsumer.js";
import savelog from "./logger.js";
import getCurrentUser from "./getCurrentUser.js"

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

const username = await getCurrentUser().username;

const plusC = document.getElementById("plusC");
const minusC = document.getElementById("minusC");
const degree = document.getElementById("degree");

degree.innerHTML = localStorage.getItem("degree") || 25;
plusC.addEventListener('click', () => {
    savelog("Increased temperature:" + username);
    degree.innerHTML = parseInt(degree.innerHTML) + 1;
    localStorage.setItem("degree", degree.innerHTML);
});

minusC.addEventListener('click', () => {
    savelog("Decreased temperature:" + username);
    degree.innerHTML = parseInt(degree.innerHTML) - 1;
    localStorage.setItem("degree", degree.innerHTML);
});


document.addEventListener('keydown', function(event) {
    if (event.key === 'c') {

      localStorage.clear();
      console.log('localStorage cleared');
    }
  });

livingRoom.checked = localStorage.getItem("livingRoomToggle") == "true";
livingRoom.addEventListener('change', () => {
  if (livingRoom.checked) {
    savelog("Turned on living room light:" + username);
    localStorage.setItem("livingRoomToggle", "true");
    startConsuming(0.1, "livingRoom");
  } else {
    savelog("Turned off living room light:" + username);
    localStorage.setItem("livingRoomToggle", "false");
    consumeFromId("livingRoom");
  }
});
kitchen.checked = localStorage.getItem("kitchenToggle") == "true";
kitchen.addEventListener('change', () => {
  if (kitchen.checked) {
    savelog("Turned on kitchen light:" + username);
    localStorage.setItem("kitchenToggle", "true");
    startConsuming(0.1, "kitchen");
  } else {
    savelog("Turned off kitchen light:" + username);
    localStorage.setItem("kitchenToggle", "false");
    consumeFromId("kitchen");
  }
});

kidsRoom.checked = localStorage.getItem("kidsRoomToggle") == "true";
kidsRoom.addEventListener('change', () => {
  if (kidsRoom.checked) {
    savelog("Turned on kids room light:" + username);
    localStorage.setItem("kidsRoomToggle", "true");
    startConsuming(0.1, "kidsRoom");
  } else {
    savelog("Turned off kids room light:" + username);
    localStorage.setItem("kidsRoomToggle", "false");
    consumeFromId("kidsRoom");
  }
});

entrance.checked = localStorage.getItem("entranceToggle") == "true";
entrance.addEventListener('change', () => {
  if (entrance.checked) {
    savelog("Turned on entrance lock:" + username);
    localStorage.setItem("entranceToggle", "true");
    startConsuming(0.1, "entrance");
  } else {
    savelog("Turned off entrance lock:" + username);
    localStorage.setItem("entranceToggle", "false");
    consumeFromId("entrance");
  }
});


storeroom.checked = localStorage.getItem("storeroomToggle") == "true";
storeroom.addEventListener('change', () => {
  if (storeroom.checked) {
    savelog("Turned on storeroom lock:" + username);
    localStorage.setItem("storeroomToggle", "true");
    startConsuming(0.1, "storeroom");
  } else {
    savelog("Turned off storeroom lock:" + username);
    localStorage.setItem("storeroomToggle", "false");
    consumeFromId("storeroom");
  }
});


garage.checked = localStorage.getItem("garageToggle") == "true";
garage.addEventListener('change', () => {
  if (garage.checked) {
    savelog("Turned on garage lock:" + username);
    localStorage.setItem("garageToggle", "true");
    startConsuming(0.1, "garage");
  } else {
    savelog("Turned off garage lock:" + username);
    localStorage.setItem("garageToggle", "false");
    consumeFromId("garage");
  }
});

conditioner.checked = localStorage.getItem("conditionerToggle") == "true";
conditioner.addEventListener('change', () => {
  if (conditioner.checked) {
    savelog("Turned on conditioner:" + username);
    localStorage.setItem("conditionerToggle", "true");
    startConsuming(0.5, "conditioner");

  } else {
    savelog("Turned off conditioner:" + username);
    localStorage.setItem("conditionerToggle", "false");
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
    <button id=toDoButton${number} class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
  </span>`

  toDoRoot.innerHTML += data;
  
  const toDoBtn = document.getElementById(`toDoButton${number}`);
    toDoBtn.addEventListener('click', () => removeToDo(number));

  localStorage.setItem('toDos', JSON.stringify(toDos));
  savelog("Added a new to do: " + username);

}

function removeToDo(id) {
    console.log(id);
      const toDos = JSON.parse(localStorage.getItem('toDos')) || [];
      toDos.splice(id-1,1);
    
      localStorage.setItem('toDos', JSON.stringify(toDos));
    
      const toDoId = document.getElementById(`toDoId${id}`);
      toDoId.remove();
    
      savelog("Removed a to do: " + username);
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
    `<span id=toDoId${number}  class="m-4 d-flex flex-row justify-content-between">
      <h5 class="m-2">${number}.</h5>
      <h5 class="m-2">${title}</h5>
      <h5 class="m-2">${description}</h5>
      <button id=toDoButton${number} class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
    </span>`

    toDoRoot.innerHTML += data;

    const toDoBtn = document.getElementById(`toDoButton${number}`);
    toDoBtn.addEventListener('click', () => removeToDo(number));
  });
}

fetchToDos();