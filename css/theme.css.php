<?php
header('Content-Type: text/css; charset=utf8');

$color_i = $_GET['color_i'];

list($r, $g, $b) = sscanf($color_i, "#%02x%02x%02x");
// echo "$hex -> $r $g $b";

?>

a {
  color: <?php echo $color_i; ?>;
}

.navbar-fixed nav {
  background-color: <?php echo $color_i; ?>;
}


.side-nav li:hover{
  background-color: <?php echo $color_i; ?>;
}
.btn ,.btn-large{
  background-color: <?php echo $color_i; ?>;
}
.btn:hover, .btn-large:hover {
  background-color: <?php echo $color_i; ?>;
}
.home-title span{
  color: <?php echo $color_i; ?>;
}
.about-inner-right>h3{
  color: <?php echo $color_i; ?>;
}
.personal-information>h3{
  color: <?php echo $color_i; ?>;
}
.title{
  color: <?php echo $color_i; ?>;
}

.card-subtitle {
  color: <?php echo $color_i; ?>;
}
.portfolio-top{
  background-color: <?php echo $color_i; ?>;
}
.filter {
  color: <?php echo $color_i; ?>;
}
.filter:focus{
  background-color: <?php echo $color_i; ?>;
}
#portfolio-list .mix:hover > a::before {
  background-color: <?php echo $color_i; ?>;
}
.counter{
  color: <?php echo $color_i; ?>;
}

.pro-bar-container.color-wisteria {
  border-color: <?php echo $color_i; ?>;
}

.pro-bar.color-amethyst {
  background-color: <?php echo $color_i; ?>;
}
.call-to-about i{
  color: <?php echo $color_i; ?>;
}

.blog-post .card-action a{
  color: <?php echo $color_i; ?>;
}

.post-comment:hover{
  color: <?php echo $color_i; ?> !important;
}

.readmore-btn:hover{
  background-color: <?php echo $color_i; ?>;
}
#experience{
  background-color: <?php echo $color_i; ?>;
}

.card-title i {
  color: <?php echo $color_i; ?>;
}
.customNavigation i{
  color: <?php echo $color_i; ?>;
}
#testimonial{
  background-color: <?php echo $color_i; ?>;
}
.testimonial-content h3 {
  color: <?php echo $color_i; ?>;
}
.footer-top{
  background-color:<?php echo $color_i; ?>;
}
input[type="text"]:focus:not([readonly]) + label,
input[type="password"]:focus:not([readonly]) + label,
input[type="email"]:focus:not([readonly]) + label,
input[type="url"]:focus:not([readonly]) + label,
input[type="time"]:focus:not([readonly]) + label,
input[type="date"]:focus:not([readonly]) + label,
input[type="datetime-local"]:focus:not([readonly]) + label,
input[type="tel"]:focus:not([readonly]) + label,
input[type="number"]:focus:not([readonly]) + label,
input[type="search"]:focus:not([readonly]) + label,
textarea.materialize-textarea:focus:not([readonly]) + label {
  color: <?php echo $color_i; ?>;
}
input[type="text"]:focus:not([readonly]),
input[type="password"]:focus:not([readonly]),
input[type="email"]:focus:not([readonly]),
input[type="url"]:focus:not([readonly]),
input[type="time"]:focus:not([readonly]),
input[type="date"]:focus:not([readonly]),
input[type="datetime-local"]:focus:not([readonly]),
input[type="tel"]:focus:not([readonly]),
input[type="number"]:focus:not([readonly]),
input[type="search"]:focus:not([readonly]),
textarea.materialize-textarea:focus:not([readonly]) {
  border-bottom: 1px solid <?php echo $color_i; ?>;
  box-shadow: 0 1px 0 0 <?php echo $color_i; ?>;
}
.submit-btn{
  color: <?php echo $color_i; ?>;
}
.submit-btn:hover,
.submit-btn:focus{
  background-color: <?php echo $color_i; ?>;
}
.overlay-header{
  background-color: <?php echo $color_i; ?>;
}
.blog-content blockquote {
  border-left: 5px solid <?php echo $color_i; ?>;
}
.share-area h4 i,
.tag-area h4 i {
  color: <?php echo $color_i; ?>;
}
.share-area a:hover,
.share-area a:focus{
  color: <?php echo $color_i; ?>;
}
.author-comments {
  background-color: <?php echo $color_i; ?> !important;
}
.reply-btn:hover{
  background-color: <?php echo $color_i; ?>;
}
.pagination li.active{
  background-color: <?php echo $color_i; ?>;
}
.card .card-action a {
  color: <?php echo $color_i; ?>;
}
.tagcloud a:hover,
.tagcloud a:focus{
  color: #fff;
  background-color: <?php echo $color_i; ?>;
  border-color: <?php echo $color_i; ?>;
}
.prev-post:hover,
.prev-post:focus,
.next-post:hover,
.next-post:focus{
  background-color: <?php echo $color_i; ?>;
}
.submit-btn{
  color: <?php echo $color_i; ?>;
}
.side-nav li:hover,
.side-nav li.active {
  background-color: <?php echo $color_i; ?>;
}
.progress .indeterminate {
  background-color: <?php echo $color_i; ?>;
}

.slider .indicators .indicator-item.active {
  background-color: <?php echo $color_i; ?>;
}

.backdrop{
   background-color: rgba(<?php echo $r .', '. $g .', '. $b ?>, 0.5);
   color: black;
 }

.fc {
  color: <?php echo $color_i; ?>;
}

.fc-unthemed .fc-today {
    background-color: rgba(<?php echo $r .', '. $g .', '. $b ?>, 0.5);
}

.fc-state-down, .fc-state-hover, button:focus {
    background-color:<?php echo $color_i; ?>;
}

.tabs .tab a.active, .tabs .tab a:hover {
    color: <?php echo $color_i; ?>;
}

.tabs .indicator {
    background-color: <?php echo $color_i; ?>;
}

.tabs .tab.disabled a, .tabs .tab.disabled a:hover, .tabs .tab a {
    color: rgba(<?php echo $r .', '. $g .', '. $b ?>, 0.5);
}

#userInfo {
    background-color: rgba(<?php echo $r .', '. $g .', '. $b ?>, 0.05);
    border-radius: 10px;
}
