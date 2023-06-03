export default function consume(electricity) {
    var consumed = getConsumed();
    var consumeItem = {electricity:electricity, day: new Date().getDay(), month: new Date().getMonth(), year: new Date().getFullYear()};

    consumed.push(consumeItem);

    localStorage.setItem('consumed', JSON.stringify(consumed));
}

export function startConsuming(electrictyPerSecond, id) {
    var item = {id:id, electrictyPerSecond:electrictyPerSecond, startDate:new Date()};

    var items = getConsumingItems();

    items.push(item);

    localStorage.setItem('consumingItems', JSON.stringify(items));
}

export function getConsumingItems() {
    return JSON.parse(localStorage.getItem('consumingItems')) || [];
}

export function getConsumeByDay(day, month, year) {
    var consumed = getConsumed();
    var total = 0;
    consumed.forEach(item => {
        if (item.day == day && item.month == month && item.year == year) {
            total += item.electricity;
        }
    });
    return total;
}

export function getConsumed() {
    return JSON.parse(localStorage.getItem('consumed')) || [];
}

export function consumeFromId(id) {
    var items = getConsumingItems();
    var item = items.find(item => item.id == id);
    if (item) {
        var electricity = item.electrictyPerSecond * ((new Date() - item.startDate) / 1000);
        consume(electricity);

        items = items.filter(item => item.id != id);
    }
}