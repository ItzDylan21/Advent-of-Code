const fs = require("fs");
const lines = fs
  .readFileSync("dag1.txt", { encoding: "utf-8" })
  .split("\n")
  .filter((x) => x)
  .map((x) => parseInt(x));
let calc;
let results;
function sonarSweep(array) {
  let count = 0;
  for (let i = 0; i < array.length; i++) {
    if (i > 0) {
      calc = array[i - 1] - array[i];
      if (calc < 0) {
        results = "Increased";
        count++;
      } else {
        results = "Decreased";
      }
    }
  }
  console.log(count);
}
function sonarSweep2(array) {
  let count = 0;
  for (let i = 0; i < array.length; i++) {
    if (i > 0) {
      calc =
        array[i - 1] +
        array[i] +
        array[i + 1] -
        (array[i] + array[i + 1] + array[i + 2]);
      if (calc < 0) {
        results = "Increased";
        count++;
      } else {
        results = "Decreased";
      }
    }
  }
  console.log(count);
}
sonarSweep(lines);
sonarSweep2(lines);
