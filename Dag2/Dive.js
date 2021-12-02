const fs = require("fs");
const lines = fs
  .readFileSync("Dag2/dag2.txt", { encoding: "utf-8" })
  .split("\n")
  .filter((x) => x);
let direction;
let amount;
function Dive1(array) {
  let horizontal = 0;
  let depth = 0;
  let result = 0;
  for (let i = 0; i < array.length; i++) {
    direction = array[i].split(" ", 1).pop();
    amount = array[i].split(" ").pop();
    amount = parseInt(amount);
    switch (direction) {
      case "forward":
        horizontal = horizontal + amount;
        break;
      case "up":
        depth = depth - amount;
        break;
      case "down":
        depth = depth + amount;
    }
  }
  result = depth * horizontal;
  console.log(result);
}
function Dive2(array) {
  let horizontal = 0;
  let depth = 0;
  let aim = 0;
  let result = 0;
  for (let i = 0; i < array.length; i++) {
    direction = array[i].split(" ", 1).pop();
    amount = array[i].split(" ").pop();
    amount = parseInt(amount);
    switch (direction) {
      case "forward":
        horizontal = horizontal + amount;
        depth = depth + aim * amount;
        break;
      case "up":
        aim = aim - amount;
        break;
      case "down":
        aim = aim + amount;
    }
  }
  result = depth * horizontal;
  console.log(result);
}
Dive1(lines);
Dive2(lines);
