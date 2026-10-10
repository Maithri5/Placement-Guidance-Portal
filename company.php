<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Company Mode</title>

  <link rel="stylesheet" href="globalstyle.css" />

</head>

<body>

<header class="site-header">

<nav class="nav-inner">

<div class="nav-logo">
<span class="bracket">{</span>
DSA_Hub
<span class="bracket">}</span>
</div>

<div class="nav-links">

<a href="codingpractice.html">Home</a>

<a href="learning.php">Learning</a>

<a href="company.php"
class="active">
Companies
</a>

</div>

</nav>

</header>

<main class="page-layout">

  <div class="page-header">
<a href="javascript:void(0);" onclick="goBack()" class="back-link">
     ← Back
</a>

 <h1 class="page-title">Company <span>Mode</span></h1>
      <p class="page-subtitle">Select a comapny to know frequently asked questions. Only one topic stays open at a time.</p>
    </div>

    <div class="search-wrap">
      <span class="search-icon">🔍</span>
      <input
        type="text"
        id="searchInput"
        placeholder="Search topics or questions…"
        autocomplete="off"
        spellcheck="false"
      />
      <button class="search-clear" id="searchClear" title="Clear search">✕</button>
    </div>


<div class="accordion-list">




<?php

include "dsadb.php";

$sql = "

SELECT 
companies.company_name,
company_questions.question_text,
company_questions.difficulty,
company_questions.platform,
company_questions.question_link

FROM companies

LEFT JOIN company_questions

ON companies.id =
company_questions.company_id

ORDER BY companies.id

";

$result = $conn->query($sql);

$current_company = "";

while($row =
$result->fetch_assoc()) {

if($current_company
!= $row['company_name']) {

if($current_company != "") {

echo "</ul></div></div>";

}

echo "<div class='accordion-item'>";

echo "<div class='accordion-header'>";

echo "<span class='acc-title'>";

echo $row['company_name'];

echo "</span>";

echo "</div>";

echo "<div class='accordion-body'>";

echo "<ul class='questions-list'>";

$current_company =
$row['company_name'];

}

if($row['question_text']) {

echo "<li class='question-item'>";

echo "<a href='" .

$row['question_link'] .

"' target='_blank'>";

echo $row['question_text'];

echo "</a>";

$difficulty =
strtolower($row['difficulty']);

echo "<span class='difficulty-tag " .

$difficulty . "'>";

echo $row['difficulty'];

echo "</span>";

$platform =
strtolower($row['platform']);

echo "<span class='platform-tag " .

$platform . "'>";

echo $row['platform'];

echo "</span>";

echo "</li>";

}

}

echo "</ul></div></div>";

$conn->close();

?>


</div>

</main>

<script src="script.js"></script>

</body>
</html>