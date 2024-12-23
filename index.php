<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>ASEEST</title>

    

    <!-- LINKS -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/2625a4d18c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css" />
    
    <style>
        :root{
  /* COLORS */
  --bg-color: #FEFEFE;
  --text-color: #fff;
  --main-color:#2F27CE;
  --secondary-color: #F4AF1B;
  --p-color: #000000;
  --p-color-light: #505050;
  --p-color-lighter: #A9A9AC;
  --btn1-color: #ffd06b;
  --btn1-color-hover: #fac34b;
  --btn2-color: #433bd8;
  --btn2-color-hover: rgb(62, 55, 181);
  --light-color1: #dbe6ff;;
  --light-color2: #fff4db;
  --light-color3: #FFF1DB;
  --line-color: #B3B2B2;

  /* SIZE FONTS */
  --heading-size1: 40px;
  --heading-size2: 30px;
  --p-size: 18px;
  --heading-size3: 20px;
}

* {
  padding: 0;
  margin: 0; 
  box-sizing:border-box;
  list-style: none;
  text-decoration: none;
  font-family: "Inter", sans-serif;
}

.login__btn {
  padding: 0.8rem 1.5rem;
  outline: none;
  border: none;
  background: none;
  font-size: 1rem;
  color: var(--text-color);
  cursor: pointer;
  transition: 0.3s;
}

.login__btn:hover {
  transform: scale(1.03);
}

body {
  font-family: "Roboto", sans-serif;
  background-color: white;
}

.container {
  max-width: 1200px;
  margin: auto;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

nav {
  padding: 10px 8%;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  background-color: var(--main-color); 
  width: 100%;
}

.nav__logo {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--text-color);
}

.nav__links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 2rem;
  font-weight: 300;
}

.link a {
  text-decoration: none;
  color: var(--text-color);
  cursor: pointer;
  transition: 0.3s;
}

.link a:hover {
  font-weight: 500;
}

.header {
  padding: 0 1rem;
  flex: 1;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem;
  align-items: center;
  margin-top: 60px;
}
.content{
  padding-left: 4rem;
}
.content h1 {
  margin-bottom: 1rem;
  font-size: 3rem;
  font-weight: 700;
  color: var(--text-dark);
}

.content h1 span {
  color: var(--secondary-color);
}

.content p {
  margin-bottom: 2rem;
  color: var(--text-light);
  line-height: 1.75rem;
}

.landPage_btn{
  justify-content:space-between;
  align-items: center;
  margin-top: 5px
 
}

.nav__btn1{
  padding: 1rem 2rem;
  outline: none;
  border: none;
  font-size: 1rem;
  color: var(--p-color);
  background-color: var(--btn1-color);
  border-radius: 5px;
  cursor: pointer;
  margin-right: 15px;
  transition: 0.3s;
}

.nav__btn1:hover {
  background-color: var(--btn1-color-hover); 
  cursor: pointer;   

}

.nav__btn2{
  padding: 1rem 2rem;
  outline: none;
  border: none;
  font-size: 1rem;
  color: var(--text-color);
  background-color: var(--btn2-color);
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.nav__btn2:hover {
  background-color: var(--btn2-color-hover);
  cursor: pointer;
}

.image {
  position: relative;
  text-align: center;
  isolation: isolate;
  
}

.image img {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
  padding-left: 4rem;
  /* max-width: 475px; */
}


/* ABOUT US */

.content-container {
  display: flex;
  flex-wrap: nowrap;
  justify-content: space-evenly;
  align-items: center;
  width: 100%;
  padding: 10px 100px;
  box-sizing: border-box;
  text-align: center;
  margin-top: 45px;

}

.text-content, .new-text-content {
  flex: 1 1 100%;
  max-width: 100%;
  padding: 20px;
}

.image-content, .new-image-content {
  flex: 1 1 100%; 
  max-width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}
.text-content, .image-content, .new-text-content, .new-image-content {
  flex: 1;
  padding: 20px;
}

.text-content h1{
  font-size: 2.5rem;
}

.text-content p{
  text-align: justify;
  margin-top: 10px;
  font-size: var(--p-size);
}
.image-content, .new-image-content {
  text-align: center;
}
img {
  max-width: 100%;
  height: auto;
}
.read-more {
  padding: 0.7rem 1.8rem;
  outline: none;
  border: none;
  font-size: 1rem;
  color: var(--p-color);
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
  margin-top: 20px;
  background-color: var(--btn2-color);
  color: var(--text-color);

}
.more-content {
  display: none;
}

/* ABOUT US RIGHT SIDE */

.circle-container {
  display: flex;
  justify-content: space-around; 
  align-items: center; 
  margin-top: 20px;
  width: 80%; 
  height: 120px;
  background-color: #F0F4FF; 
  padding: 10px; 
}
.circle {
  position: relative;
  width: 50px; 
  height: 50px; 
  border-radius: 50%;
  background-color: var(--main-color);
  color: white;
  font-weight: bold;
  text-align: center; 
  line-height: 50px; 
  margin-bottom: 15px;
}
.circle span {
  font-size: 18px; 
  display: block; 
}
.circle-text {
  text-align: center;
  margin-top: 3px;
  color: var(--p-color);
  font-size: 10px;
  line-height: 1; 
}




/* MISSION VISION TEAM */
.div1, .div2, .div3 {
  width: 21em;
  height: 25em;
  background-color: white;
  padding: 10px 30px;
  border-radius: 10px;
  box-sizing: border-box; 
  overflow: hidden; 
  display: flex;
  flex-direction: column; 
  box-shadow: 0px 0px 2px 1px rgb(160, 150, 150);
  -webkit-box-shadow: 0px 0px 2px 1px rgb(160, 150, 150);
  -moz-box-shadow: 0px 0px 2px 1px rgb(160, 150, 150);
  color: #000000;
}

.tmvContainer i{
  color: var(--secondary-color);
  font-size: 35px;
}

.tmvContainer p{
  text-align: justify;
}

.more-content {
  display: none; 
}

.login__btn a{
  color: inherit;
}
.tmvContainer {
  display: flex;
  height: 100vh;
  align-items: center;
  gap: 3em;
  flex-grow: 1;
  padding: 0 40px;
  justify-content: center;
  text-align: center;
}

.tmvContainer h1 {
  margin-bottom: 1rem;
  font-size: var(--heading-size2);
}

/* SCHOLRSHIP OFFERRED */


.schlrshp1, .schlrshp2, .schlrshp3 {
  width: 22em;
  background-color: #e7ecfa;
  height: 21em;
  padding: 10px 30px;
  border-radius: 10px;
  box-sizing: border-box; 
  overflow: hidden; 
  display: flex;
  flex-direction: column; 
  color: #000000;
}


.schlrshpContainer {
  display: flex;
  height: 65vh;
  align-items: center;
  gap: 3em;
  flex-grow: 1;
  padding: 0 40px;
  justify-content: center;
  text-align: justify;
}

.schlrshpContainer h3 {
  font-size: var(--heading-size2);
  text-align: center;
}

.schlrshpContainer .schlrshp1 hr, .schlrshp2 hr, .schlrshp3 hr{
  background-color: #000000;
  height: 1px;
  border: none;
  margin-bottom: 15px;
  
}

.schlrshpContainer i{
  color: var(--secondary-color);
  font-weight: 950;
}


.schlrshpContainer ul {
  list-style-type: disc !important;
  padding-left: 20px !important;
}

.headingScholarship h1 {
  margin-bottom: 1rem;
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--text-dark);
  text-align: center;
}

.headingScholarship p {
  color: var(--text-light);
  text-align: center;
}

.headingScholarship{
  align-items: center;

}

/* REASONS */

.reasonsSection{
  margin-top: 4rem;
}
.reasonsContainer{
  margin: 1rem 0 0 0;
  display: grid;
  justify-content: center;
  grid-template-columns: 40% 40%;
  grid-template-rows: 200px 200px;
  gap: 30px;
  
}

.reason{
  background: white;
  border-radius: 15px;
  border: 2px solid var(--main-color);
}

.reason:nth-child(3){
  height: 12.7rem;
  border: 2px solid var(--secondary-color);
}

.reason:nth-child(2){
  border: 2px solid var(--secondary-color);
}

.reason:nth-child(4){
  height: 12.7rem;
}
.reason p{
  color: black;
  font-size: 1rem;
  text-align: center;
  margin: 0;
  padding: 5px;
}

@media (max-width: 700px){
  .reasonsContainer{
    grid-template-columns: minmax(100px, 2fr);
  }
}

.title_reasons h1{
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--text-dark);
  text-align: center;

}

.reasonDesc{
  text-align: center;
  padding: 60px 0;
}
/* FAQ SECTION */

.title_div h1 {
  margin-bottom: 1rem;
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--text-dark);
  text-align: center;
}

.title_div h1 span{
  color: var(--main-color);
}

.title_div p {
  color: var(--text-light);
  text-align: center;
}

.title_div{
  align-items: center;
  margin-top: 40px;

}

.faqContainer{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 65vh;
  
  
}
.wrapper{
  max-width: 900px;
  padding: 0 20px;
  


}

.wrapper .parent-tab, .wrapper .child-tab{
  margin-bottom: 8px;
  border-radius: 3px;
  }

.wrapper .parent-tab label, .wrapper .child-tab label{
  background-color: #e7ecfa;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  border-radius: 5px;
  position: relative;
  z-index: 99;
  
}


.parent-tab input:checked  ~ label .icon i:before, 
.child-tab input:checked  ~ label .icon i:before{
  content: '\f068';

}

.wrapper label span{
  color: #000000;
  font-size: 18px;
  font-weight: 500;
  

}

.child-tab label span{
  font-size: 17px;

}

.wrapper label .icon{
  position: relative;
  height: 30px;
  width: 30px; 
  font-size: 15px;
  color: var(--main-color);
  border: initial;
  display: block;

}

.wrapper label .icon i{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.wrapper .parent-tab .faqContent, .wrapper .child-tab .sub-content{
  max-height: 0px;
  overflow: hidden;
  transition: all 0.4s ease;
  border-left: 1px solid #bacff0;
  margin-left: 20px;
  margin-top: 5px;
}

.parent-tab input:checked ~ .faqContent, .child-tab input:checked ~ .sub-content{
  max-height: 100vh;
}

.tab-3 input:checked ~ .faqContent{
  padding: 15px 20px;
}
.wrapper .parent-tab .faqContent p, .wrapper .parent-tab .faqContent li, .wrapper .child-tab .sub-content p{
  font-size: 16px;
  padding: 15px 20px;
  text-align: justify;
 
}

ol li {
  list-style: decimal;
  list-style-position: inside;
}

.wrapper input{
  display: none;
}

.faqSection{
  margin-top: 200px;
}


/* STEPS SCHOLARSHIP */

.headingStep h1 {
  margin-bottom: 1rem;
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--text-dark);
  text-align: center;
}

.headingStep p {
  color: var(--text-light);
  text-align: center;
}

.headingStep{
  margin-bottom: 40px;
  margin-top: 40px;
}

.stepper-wrapper {
  margin-top: auto;
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.stepper-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;

  @media (max-width: 768px) {
    font-size: 12px;
  }
}


.stepper-item::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 37px;
  left: 50%;
  z-index: 2;
}

.stepper-item .step-counter {
  position: relative;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--line-color);
  margin-bottom: 6px;
}

.stepper-item.active {
  font-weight: bold;
}

.stepper-item.blue .step-counter {
  background-color: #2F27CE;
  color: white;
}

.stepper-item.orange .step-counter {
  background-color: #FFAA61;
  color: white;
}

.step{
  font-weight: bold;
  color: #505050;
}
/* .stepper-item.blue::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #4bb543;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 3;
} */

.step-name{
  font-weight: bold;
  text-align: center;
}

.title-desc{
  text-align: center;
}

.stepper-item:first-child::before {
  content: none;
}
.stepper-item:last-child::after {
  content: none;
}



/* CONTACT US AND NEWSLETTER */
.contactContainer{
  display: inline-block;
  text-align: center;
  background-color: #F0F4FF;
  color: #000000;
  padding: 25px;
  border-radius: 8px;
  padding: 2rem;

}

.contactContainer header{
  font-size: 1.5rem;
  color: #333;
  font-weight: 500;
}

.contactContainer .form {
  margin-top: 30px;
  display: inline-block;
  text-align: left;
}

.form .input-box {
  width: 100%;
  margin-top: 20px;   
}

.input-box label {
  color: #333;
  font-weight: 550;
}

.form .input-box input {
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: #707070;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0 15px;
}

.form .column {
  display: flex;
} 

textarea{
  width: 80%;
  height: 100px;
  border-radius: 10px;
  padding: 5px;
}

textarea , button {
  border: none;
}

#messageBTN{
  height: 35px;
  outline: none;
  border: none;
  font-size: 1rem;
  color: var(--p-color);
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
  background-color: var(--btn2-color);
  color: var(--text-color);
  margin-top: 30px;
  padding: 5px;
}

.buttonapply button:hover{
  background-color: var(--btn2-color-hover);
}

.message {
 display: flex;
 justify-content: space-between;
}

hr {
  width: 100%; 
  height: 1px;
  border: none;
  position: relative;
  background: #000000;
  margin-top: 30px;
}

.newsletterContainer {
  max-width: 700px;
  background-color: #F0F4FF;
  color: #000000;
  padding: 25px;
  border-radius: 8px;
  width: auto;
  height: auto;
  padding: 2rem;
}
.email-box input{
  height: 50px;
  width: 60%;
  outline: none;
  font-size: 1rem;
  color: #707070;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0 15px;
}
#emailBTN{
  height: 35px;
  width: 150px;
  border-radius: 5px;
  background: #2921bd;
  color: white;
  margin-left: 20px;
  cursor: pointer;
}
.cont{
  display: inline-flex;
  justify-content: space-around;
  width: 100%;
  height: auto;
  padding: 5rem;
  gap: 20px;
}
.container_cn{
  background-color: #F0F4FF;
  color: #000000;
  width: auto;
  height: auto;
  padding: 2rem;
}
.btn-custom {
      background-color: #2F27CE;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      transition: background-color 0.3s;
    }

.btn-custom:hover {
    background-color: #241EA5;
}

.section-heading {
    margin-bottom: 20px;
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
}


/* FOOTER */
footer {
            background-color: #2F27CE; 
            color: white; 
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        
        footer p {
            margin: 0;
            font-size: 14px;
        }
        
        
        @media (max-width: 768px) {
            footer p {
                font-size: 12px;
            }
        }

  



@media (max-width: 1200px) {
  .more-content {
    display: none; 
  }
}


@media (max-width: 1200px) {
  .tmvContainer {
    height: 100%;
    flex-direction: column;
    padding: 30px 0;
  }

  .div1, .div2, .div3 {
    max-width: 80%;
    width: auto; 
    padding: 30px;
    height: auto; 
  }

  .schlrshpContainer {
    height: 100%;
    flex-direction: column;
    padding: 30px 0; 
  }

  .schlrshp1, .schlrshp2, .schlrshp3 {
    max-width: 80%;
    width: auto;
    padding: 30px;
    height: auto;
  }
}


@media (width < 900px) {

  nav{
    width: 100%;
  }
  .nav__links {
    display: none;
  }

  .header {
    padding: 1rem;
    padding-bottom: 11rem;
    grid-template-columns: repeat(1, 1fr);
  }

  .content {
    text-align: center;
    padding: 0;
  }

  .image {
    display: none;

  }

  .contactContainer{
    display: flex;
    height: auto;
  }
}

@media (width < 1105px) {
  .image {
    margin-right: 2rem;

  }
}

@media (max-width: 900px) {
  .content-container {
    flex-direction: column;
    align-items: center;
    padding: 0.5rem 1rem;
    text-align: center;
  }

  .text-content, .image-content {
    flex: 1 1 100%;
    max-width: 100%;
    padding: 10px;
  }

  .circle-container {
    flex-wrap: wrap; 
    justify-content: center; 
    width: 100%;
    height: auto;
    margin-top: 10px;
  
    }
    .header {
      padding: 0.rem 1rem;
    }

  }


@media (max-width: 1200px) {
  .more-content {
    display: none; 
  }
}


@media (max-width: 1200px) {
  .tmvContainer {
    height: 100%;
    flex-direction: column;
    padding: 30px 0; 
  }

  .div1, .div2, .div3 {
    max-width: 80%;
    width: auto; 
    padding: 30px;
    height: auto; 
  }

  .schlrshpContainer {
    height: 100%;
    flex-direction: column;
    padding: 30px 0; 
  }

  .schlrshp1, .schlrshp2, .schlrshp3 {
    max-width: 80%;
    width: auto; 
    padding: 30px;
    height: auto; 
  }
  .circle-text {
    text-align: center;
    margin-top: 3px;
    color: var(--p-color);
    font-size: 8px;
    line-height: 1; 
  }
  
}


@media (width < 900px) {

  nav{
    width: 100%;
  }
  .nav__links {
    display: none;
  }

  .header {
    padding: 1rem 1rem;
    display: flex;
    justify-content: space-between;
  }

  .content {
    height: auto;
    width: 100vw;
    text-align: center;
    padding: 0;
  }

  .image {
    display: none;
  }

   /* MEDIA QUERY FOR Contact Us */
  .email-box {
    display: inline;
  }
  
  .email-box input {
    width: 100%;
  }

  #emailBTN {
    width: 100%;
    margin-top: 10px;
    margin-left: -1px;
    
  }

  
  textarea{
    width: 100%;
    height: 100px;
    border-radius: 10px;
    padding: 5px;
  }
  
  #messageBTN{
    height: 35px;
    width: 100%;
    padding: 5px;
  }
  
  .message {
    display: inline-block;
    width: 100%;
  }

  .cont{
    justify-content: center;
  }
 
}
/* Contact US */
@media (width < 575px) {
 
  .form .column {
    display: inline-block;
  }

  .newsletterContainer h1 {
    text-align: center ;
  }
  
  .newsletterContainer p{
    text-align: justify;
  }

}


@media (width < 1105px) {
  .image {
    margin-right: 2rem;
  }
}


@media (max-width: 1100px) {
  .content-container {
    flex-direction: column;
    align-items: center;
    padding: 0.5rem 1rem;
    text-align: center;
  }

  .text-content, .image-content {
    flex: 1 1 100%;
    max-width: 100%;
    padding: 10px;
  }
  
  .circle-container {
    flex-wrap: wrap; 
    justify-content: space-evenly;
    width: 100%;
    height: auto;
    margin-top: 10px;
  
    }

  }

@media (max-width: 700px){
  .footerNav ul{
    flex-direction: column;
  }

  .footerNavul li{
    width: 100%;
    text-align: center;
    margin: 10px;
  }
}

    </style>
  </head>
<body>

    <!-- NAVIGATION BAR -->
    <div class="container" id="container">
      <nav>
        <div class="nav__logo">ASEEST</div>
        <ul class="nav__links">
          <li class="link"><a href="#container">Home</a></li>
          <li class="link"><a href="#content-container">About</a></li>
          <li class="link"><a href="#faq_section">FAQs</a></li>
          <li class="link"><a href="#cont">Contact</a></li>
        </ul>

       

        <a href="login.php" class="login__btn">
          <i class='bx bxs-user-circle'></i>
          <span>Login</span>
      </a>

     
      </nav>

      <!-- LANDPAGE CONTENT -->
      <header class="header">
        <div class="content">
          <h1>Find scholarships, apply easily, and manage records—<span>all in one!</span></h1>
          <p>ASEEST offers a hassle-free platform for applying to scholarships effortlessly,
            progress tracking with ease, convenient record management. All within the convenience 
            of a single platform.</p>
          <div class="landPage_btn">
            <button class="nav__btn1" onclick="location.href='#content-container'">Learn More</button>
            <a class="nav__btn2" href="applicationform.php">Apply Now</a>
          </div>
        </div>
        <div class="image">
          <span class="image__bg"></span>
          <img src="https://cdn.pixabay.com/photo/2024/04/03/05/49/created-by-ai-8672131_1280.png" alt="header image" />
        </div>
      </header>
    </div>

    <!-- ABOUT ASEEST -->
    <div class="content-container" id="content-container">
      <div class="text-content">
          <h1>ABOUT ASEEST</h1>
          <p>ASEEST (Application Scholarship Eligibility Evaluation System Technology) is a platform designed to simplify 
            the scholarship application process. It helps students apply for scholarships, 
            track their application status, and receive updates.</p>

            <div class="more-content">
              <p>For administrators, ASEEST provides automated eligibility checks and efficient 
                evaluation tools, reducing administrative burden and ensuring fair and transparent scholarship awards. 
                This technology-driven system enhances efficiency and fairness in the scholarship process.</p>
              </div>
              <button class="read-more">Read More</button>
     
      </div>
      <div class="image-content">
          <div class="circle-container">
              <div class="circle">
                  <span>A</span>
                  <div class="circle-text">Application</div>
              </div>
              <div class="circle">
                  <span>S</span>
                  <div class="circle-text">Scholarship</div>
              </div>
              <div class="circle">
                  <span>E</span>
                  <div class="circle-text">Eligibility</div>
              </div>
              <div class="circle">
                  <span>E</span>
                  <div class="circle-text">Evaluation</div>
              </div>
              <div class="circle">
                  <span>S</span>
                  <div class="circle-text">System</div>
              </div>
              <div class="circle">
                  <span>T</span>
                  <div class="circle-text">Technology</div>
              </div>
              <!-- <p>Application for Scholarship and Eligibility Evaluation System and Technology</p> -->
          </div>
      </div>
    </div>
    
  <!-- MISSION, VISION, team -->

  <div class="tmvContainer">
    <div class="div1">
      <i class="ri-team-fill"></i>
      <h1>Our team</h1>
      <p>Our team is composed entirely of students who understand firsthand the 
        challenges and opportunities within the scholarship landscape. We bring 
        together our diverse experiences and skills to create a system that is 
        intuitive and beneficial for administrators, applicants, and scholars alike. 
        Driven by our collective passion for education and support for our peers, we 
        are committed to making scholarships more accessible and easier to navigate 
        for everyone involved.  
      </p>
  </div>
  
    <div class="div2">
      <i class="ri-focus-2-line"></i>
        <h1>Our Mission</h1>
        <p>Our mission is to simplify the scholarship process for students, administrators, 
          and scholars. We aim to provide a user-friendly platform that connects students 
          with opportunities and assists administrators in managing applications efficiently. 
          By creating an accessible and transparent system, we strive to empower students to 
          achieve their educational goals without financial barriers, making the journey to 
          higher education smoother and more attainable for all.
        </p>
         
    </div>      
        
    <div class="div3">
      <i class="ri-lightbulb-line"></i>
        <h1>Our Vision</h1>
        <p>We envision a future where every student has equal access to scholarships, and the 
          process of securing financial aid is straightforward and stress-free. By fostering a 
          community-driven platform, we aim to build a world where educational opportunities are 
          within reach for all, regardless of their background. Our goal is to create a supportive 
          ecosystem where students can focus on their academic and personal growth without the burden 
          of financial concerns
          </p>
        
    </div> 
  </div>

  <!-- SCHOLARSHIP OFFERED -->

  <div class="scholarshipContent">
    <div class="headingScholarship">
      <h1>SCHOLARSHIPS OFFERED</h1>
      <p>Embark on a journey of academic excellence and personal growth through the scholarships offered.</p>
  </div>

    <div class="schlrshpContainer">


      <div class="schlrshp1">
        <h3 class="heading-schlrshp">Full Scholarship</h3>
                <hr>
            <h4 class="req">Requirements</h4>
            <p class="req1"><i class="ri-check-line"></i> must have a GWA (General Weighted Average) of 90 and above</p>
            <p class="req3"><i class="ri-check-line"></i> must submit the following documents:</p>
            <ul>
              <li>- Birth Certificate</li>
              <li>- Certificate of Indigency</li>
              <li>- Certificate of Good Moral Character</li>
              <li>- Form 137</li>
            </ul>
           
          </div>
      <div class="schlrshp2">
        <h3 class="heading-schlrshp">Grant Level 1</h3>
                <hr>
            <h4 class="req">Requirements</h4>
            <p class="req1"><i class="ri-check-line"></i> must have a GWA (General Weighted Average) of 88 to 89</p>
            <p class="req2"><i class="ri-check-line"></i> must have an eligibility score of </p>
            <p class="req3"><i class="ri-check-line"></i> must submit the following documents:</p>
            <ul>
              <li>Birth Certificate</li>
              <li>Indigency Certificate</li>
              <li>Certificate of Good Moral Character</li>
              <li>Form 137</li>
            </ul>
           
      </div>
      <div class="schlrshp3">
        <h3 class="heading-schlrshp">Grant Level 2 </h3>
                <hr>
            <h4 class="req">Requirements</h4>
            <p class="req1"><i class="ri-check-line"></i> must have a GWA (General Weighted Average) of 85 to 87</p>
            <p class="req3"><i class="ri-check-line"></i> must submit the following documents:</p>
            <ul>
              <li>Birth Certificate</li>
              <li>Indigency Certificate</li>
              <li>Certificate of Good Moral Character</li>
              <li>Form 137</li>
            </ul>
           
          </div>
    </div>

  </div>



  <!-- STEPS SCHOLARSHIP -->
  <div class="stepsContent">
    <div class="headingStep">
      <h1>APPLICATION PROCESS</h1>
      <p> Follow these steps to unlock opportunities 
        and pursue your dreams.</p>
    </div>
  <div class="stepper-wrapper">
    <div class="stepper-item blue">
      <div class="step">Step</div>
      <div class="step-counter">1</div>
      <div class="step-name">Choose a Scholarship Type</div>
      <div class="title-desc"><p>Select and ensure that your current 
        requirements align with the criteria of your 
        chosen scholarship.</p></div>
    </div>
    <div class="stepper-item orange">
      <div class="step">Step</div>
      <div class="step-counter">2</div>
      <div class="step-name">Apply</div>
      <div class="title-desc"><p>Fill out the provided application form 
        to proceed with the scholarship application.</p></div>
    </div>
    <div class="stepper-item blue">
      <div class="step">Step</div>
      <div class="step-counter">3</div>
      <div class="step-name">Pass Requirements</div>
      <div class="title-desc"><p>Submit the required documents and ensure 
        that they are readable and follows the specified file format</p></div>
    </div>
    
    <div class="stepper-item orange">
      <div class="step">Step</div>  
      <div class="step-counter">4</div>
      <div class="step-name">Be Notified</div>
      <div class="title-desc"><p>Wait for further announcements regarding the 
        application status which will be communicated through SMS/email.</p></div>
    </div>
  </div>
  </div>

  <!-- REASONS -->
<div class="reasonsSection">
  <div class="title_reasons">
    <h1>WHY CHOOSE ASEEST?</h1>
  </div>
  <div class="reasonsContainer">
    <div class="reason">
      <div class="reasonDesc">
        <h3>Record Management</h3>
        <p>Effortlessly organize and securely store scholarship-related 
          data for easy access and management.</p>
      </div>
    </div>
    <div class="reason">
      <div class="reasonDesc">
        <h3>Fast Application Process</h3>
        <p>Speed up the application process with simplified workflows, 
          reducing wait times for applicants.</p>
      </div>
    </div>
    <div class="reason">
      <div class="reasonDesc">
        <h3>Accessible for all</h3>
        <p>ASEEST ensures that every applicant, regardless of background or device, can effortlessly navigate the system. 
          This promotes equal opportunities for all aspiring candidates.</p>
      </div>
    </div>
    <div class="reason">
      <div class="reasonDesc">
        <h3>Promotes Clear Communication</h3>
        <p> Facilitate transparent communication among all stakeholders, ensuring everyone stays 
          informed about application status and updates.</p>
      </div>
    </div>
  </div>
</div>


<!-- FAQs SECTION -->

<div class="faqSection" id="faq_section">
<div class="title_div">
  <h1>FREQUENTLY ASKED QUESTIONS</h1>
  <p>Your questions answered here.</p>
</div>

<div class="faqContainer">
<div class="wrapper">

  

  <!-- FAQ 1 -->
  <div class="parent-tab">
    <input type="checkbox" name="tab" id="tab-1">
    <label for="tab-1">
      <span>How to apply?</span>
      <div class="icon">
        <i class="fa-solid fa-plus"></i>
      </div>
    </label>

    <div class="faqContent">
      <ol>
        <li>Decide which scholarship program you want to apply for. </li>
        <li>Fill Out the Application Form. </li>
        <li>Prepare the Required Documents. </li>
        <li>Submit the Application. </li>
        <li>Wait for the Qualifying Interview. </li>
        <li>Wait for the Results.</li>
      </ol>
    </div>
  </div>

  
  <!-- FAQ 2 -->
  <div class="parent-tab">
    <input type="checkbox" name="tab" id="tab-2">
    <label for="tab-2">
      <span>What is the selection process for the scholarships?</span>
      <div class="icon">
        <i class="fa-solid fa-plus"></i>
      </div>
    </label>

    <div class="faqContent">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, sed fugit a aperiam quisquam ad rem molestias saepe sapiente laboriosam quas corrupti nam nesciunt atque.</p>
    </div>
  </div>

  <!-- FAQ 3 -->
 
  <div class="parent-tab tab-3">
    <input type="checkbox" name="tab" id="tab-3">
    <label for="tab-3">
      <span>What are the different types of scholarships available?</span>
      <div class="icon">
        <i class="fa-solid fa-plus"></i>
      </div>
    </label>

    <div class="faqContent">

      <!-- SUB-FAQ 1 -->
      <div class="child-tab">
        <input type="checkbox" id="tab-4">
          <label for="tab-4">
            <span>Full Scholarship</span>
            <div class="icon">
              <i class="fa-solid fa-plus"></i>
            </div>
          </label>

          <div class="sub-content">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, excepturi.</p>
          </div>
      </div>

       <!-- SUB-FAQ 2 -->
       <div class="child-tab">
        <input type="checkbox" id="tab-5">
        <label for="tab-5">
          <span>Grant Level 1</span>
          <div class="icon">
            <i class="fa-solid fa-plus"></i>
          </div>
        </label>

        <div class="sub-content">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, excepturi.</p>
        </div>
    </div>

     <!-- SUB-FAQ 3 -->
     <div class="child-tab">
      <input type="checkbox" id="tab-6">
      <label for="tab-6">
        <span>Grant Level 2</span>
        <div class="icon">
          <i class="fa-solid fa-plus"></i>
        </div>
      </label>

      <div class="sub-content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, excepturi.</p>
      </div>
  </div>
    </div>
  </div>

  <!-- FAQ 4 -->
  <div class="parent-tab">
    <input type="checkbox" name="tab" id="tab-7">
    <label for="tab-7">
      <span> What are the eligibility requirements for the scholarships?</span>
      <div class="icon">
        <i class="fa-solid fa-plus"></i>
      </div>
    </label>

    <div class="faqContent">
      <p>The applicant must have an overall percentage ranging from 100% to 90% to be 
        approved in the Full Scholarship, 89%-80% for Grant Level 1, and 79%-60% for 
        Grant Level 2.  </p>
    </div>
  </div>

  <!-- FAQ 5 -->
  <div class="parent-tab">
    <input type="checkbox" name="tab" id="tab-8">
    <label for="tab-8">
      <span>What benefits are included in the scholarships? </span>
      <div class="icon">
        <i class="fa-solid fa-plus"></i>
      </div>
    </label>

    <div class="faqContent">
      <p>Full scholars will receive a monthly allowance of ₱8,000 plus an 
        additional ₱2,500 for books, while Grantee Level 1 scholars will 
        receive a monthly allowance of ₱8,000. For Grantee Level 2, scholars 
        will receive a monthly allowance of ₱4,000.</p>
    </div>
  </div>

   <!-- FAQ 6 -->
   <div class="parent-tab">
    <input type="checkbox" name="tab" id="tab-9">
    <label for="tab-9">
      <span>What are the obligations of the scholars?</span>
      <div class="icon">
        <i class="fa-solid fa-plus"></i>
      </div>
    </label>

    <div class="faqContent">
      <p>Full scholars are required to maintain a minimum average of 2.00, 
        and grades falling below 2.001 result in immediate elimination with no 
        chance for demotion. Grantee level 1 scholars also maintain a 2.00 average;
        however, a decrease in grades between 2.001 to 2.25 leads to demotion to 
        grantee level 2. Lastly, grantee level 2 needs to maintain an average that 
        should fall between 2.001 to 2.25.  In any case of grades increasing to 2.00 above, 
        the scholar will be promoted to grantee level 1. Both grantee level 1 and 2 cannot 
        be promoted to full scholar, amidst the increasing of grades.  </p>
    </div>
  </div>

</div>  
</div>
</div>

   <!-- CONTACT US SECTION -->
   <div class="cont" id="cont">
    <div class="container_cn">
        <div class="contactUs">
            <h1>Contact Us</h1>
            <form action="#" class="form" id="contactForm">
            <div class="column">
                <div class="input-box">
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="name" id="full-name" placeholder="Enter Full Name" required>
                </div>
                
                <div class="input-box">
                    <label>Contact Number</label>
                    <input type="tel" class="form-control" name="phone" id="contact-number" placeholder="0912 345 6789" required>
                </div>
        
            </div>

            <div class="input-box">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
            </div>

            <div class="input-box">
                <label>Message</label>
                <div class="message">
                    <textarea class="form-control" name="message" id="message" placeholder="Write your message here" rows="4" required></textarea>
                    <button type="submit" id="messageBTN">Send Message</button>
                </div>
            </div>
        </form>    
        <hr>
        <div class="newsletterContainer">
            <form id="newsletterForm" action="">
                <h1>Join Our Newsletter</h1>
                <p>Don't miss out on the valuable information and opportunities available to our newsletter subscribers.</p>
                <div class="email-box">
                    <input name= "newsEmail" type="email" name="" id="" placeholder="Enter Your Email">
                    <button type="submit" name="button" id="emailBTN">Subscribe</button>
                </div>
            </form>
        </div>
    </div>  
    
 </div>
   </div>

   <!-- FOOTER -->
   <footer>
    <p>&copy; 2024 ASEEST. All Rights Reserved.</p>
</footer>
    
   <script>
document.querySelectorAll('.read-more').forEach(button => {
  button.addEventListener('click', () => {
      const moreContent = button.previousElementSibling;
      if (moreContent.style.display === 'block' || moreContent.style.display === '') {
          moreContent.style.display = 'none';
          button.textContent = 'Read More';
      } else {
          moreContent.style.display = 'block';
          button.textContent = 'Read Less';
      }
  });
});
</script>
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script type="text/javascript">
   (function(){
      emailjs.init({
        publicKey: "VvNK_GodtbuEqiIf5",
      });
   })();
</script>
<script>
    emailjs.init('VvNK_GodtbuEqiIf5'); 
    
  

document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault(); 

  
  const form = e.target;
  const formData = new FormData(form);

  
  const templateParams = {
    name: formData.get('name'),
    phone: formData.get('phone'),
    email: formData.get('email'),
    message: formData.get('message')
  };

 
  emailjs.send('service_g4vqaoo', 'template_v949s18', templateParams)
    .then(function(response) {
      console.log('SUCCESS!', response);
      alert('Message sent successfully!');
      form.reset(); 
    })
    .catch(function(error) {
      console.log('FAILED...', error);
      alert('Failed to send the message. Please try again later.');
    });
});

document.getElementById('newsletterForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const newsform = e.target;
  const newsformData = new FormData(newsform);

  const newstemplateParams = {
    email: newsformData.get('newsEmail')
  };

  emailjs.send('service_g4vqaoo', 'template_ju8t3be', newstemplateParams)
    .then(function(response) {
      console.log('SUCCESS!', response);
      alert('Newsletter subscription successful!');
      newsform.reset(); 
    })
    .catch(function(error) {
      console.log('FAILED...', error);
      alert('Failed to subscribe to the newsletter. Please try again later.');
    });
});

  </script>
  

</body>
</html>