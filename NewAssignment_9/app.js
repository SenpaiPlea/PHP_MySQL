/*
  Assignment 9 — CPS276 Gradebook
  Chapter 11: JavaScript language basics

  Write the functions below. Do not change the students array.
  Open index.html, then press F12 and use the Console tab.
  Do not use the DOM, events, forms, Fetch, or PHP.

1. Why did you write letterGrade as a function instead of copying the same if / else for every student?

2. What is the difference between const and let? Where did you use each in this assignment, and why?

3. Why does this course prefer === over ==? Give a short example of how == can surprise you.

4. In passingNames, explain what filter, map, and join each do to the student list.

5. Why is this assignment console-only? What will Chapter 12 add?
Why would you still not store real course grades only in JavaScript?
*/

const course = "CPS276";

const students = [
  { name: "Ava Chen", email: "  Ava.Chen@WCCNet.edu ", score: 94 },
  { name: "Ben Ortiz", email: "BEN.ORTIZ@wccnet.edu", score: 81 },
  { name: "Cara Singh", email: "  cara.singh@WCCNET.EDU", score: 73 },
  { name: "Drew Patel", email: " drew.patel@wccnet.edu ", score: 66 },
  { name: "Elena Brooks", email: "ELENA.BROOKS@WCCNet.edu", score: 88 }
];

function cleanEmail(rawEmail) {
  return rawEmail.trim().toLowerCase();
}

function letterGrade(score) {
  if (score >= 90) {
    return "A";
  } else if (score >= 80) {
    return "B";
  } else if (score >= 70) {
    return "C";
  } else {
    return "F";
  }
}

function statusLabel(score) {
  return score >= 70 ? "pass" : "fail";
}

function classAverage(list) {
  const total = list.reduce((sum, student) => sum + student.score, 0);
  return total / list.length;
}

function passingNames(list) {
  return list
    .filter(student => student.score >= 70)
    .map(student => student.name)
    .join(", ");
}

function printReport(list) {
  console.log(`=== ${course} Gradebook ===`);

  // These need let because their values change as the loop runs.
  let passedCount = 0;
  let failedCount = 0;

  for (const student of list) {
    // Calculate the values for each student, then use them in the output.
    const email = cleanEmail(student.email);
    const letter = letterGrade(student.score);
    const status = statusLabel(student.score);

    console.log(
      `${student.name} | ${email} | ${student.score} | ${letter} | ${status}`
    );

    if (status === "pass") {
      passedCount++;
    } else {
      failedCount++;
    }
  }

  console.log(`Class average: ${classAverage(list).toFixed(1)}`);
  console.log(`Passing students: ${passingNames(list)}`);
  console.log(`Passed: ${passedCount}`);
  console.log(`Failed: ${failedCount}`);
  console.log("");

}

printReport(students);
