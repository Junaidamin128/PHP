let arr = [
  { country: "PK", city: "Islamabad", code: 1 },
  { country: "PK", city: "Faisalabad", code: 2 },
  { country: "IN", city: "Islamabad", code: 3 },
  { country: "China", city: "Islamabad", code: 4 },
];

let arr2 = {};

for (let a of arr) {
  let country = a.country;
  let city = a.city;
  if (!arr2[country]) {
    arr2[country] = {};
  }
  if (!arr2[country][city]) {
    arr2[country][city] = {};
  }
  arr2[country][city].code = a.code;
}


let arr3 = [];

for(let country in arr2)
{
    let data = arr2[country];
    for(let city in data)
    {
        let code = data[city].code;
    }
}