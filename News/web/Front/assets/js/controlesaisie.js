function verifFormcat(f)

{


var nomcatOk = verifNomcat(f.nomcat);
  
if(nomcatOk)

      return true;

   else

   {

      alert('Veuillez remplir correctement tous les champs')

      return false;

   }

}


	function surligne(champ, erreur)

	{
	
	   if(erreur)
	
		  champ.style.backgroundColor = "#fba";
	
	   else
	
		  champ.style.backgroundColor = "";
	
	}

	function verifNomcat(champ)
{

	if(champ.value.length < 5 || champ.value.length > 25)
	{
	   surligne(champ, true);
	   return false;
	}
	else
	{
	   surligne(champ, false);
	   return true;
	}
}
function verifPrenom(champ)
{
   if(champ.value.length < 5 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}



function verifMail(champ)

{

   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;

   if(!regex.test(champ.value))

   {

      surligne(champ, true);

      return false;

   }

   else

   {

      surligne(champ, false);

      return true;

   }

}

function verifCin(champ)

{

   var regex = /^[0-9]*$/;
if(champ.value.length < 8 || champ.value.length > 8 || !regex.test(champ.value))
{

      surligne(champ, true);

      return false;

   }
   else

   {

      surligne(champ, false);

      return true;

   }

}
function verifAge(champ)

{

   var regex = /^[0-9]*$/;
if(champ.value.length < 2 || champ.value.length > 2 || !regex.test(champ.value) || champ.value<16)
{

      surligne(champ, true);

      return false;

   }
   else

   {

      surligne(champ, false);

      return true;

   }

}
function verifCin1(champ)

{

   var regex = /^[0-9]*$/;
if(champ.value.length < 4 || champ.value.length > 4 || !regex.test(champ.value))
{

      surligne(champ, true);

      return false;

   }
   else

   {

      surligne(champ, false);

      return true;

   }

}
function verifnom(champ)

{

   var regex = /^[a-zA-Z()]+$/;

   if(!regex.test(champ.value) || champ.value.length < 5 || champ.value.length > 25)

   {

      surligne(champ, true);

      return false;

   }

   else

   {

      surligne(champ, false);

      return true;

   }
}

function verifForm(f)

{

   var pseudoOk = verifPrenom(f.user);
   var telOk = verifCin(f.telephone);
   var mailOk = verifMail(f.mail);
   var mdpOk = verifPrenom(f.mdp);
   var cinOK = verifCin(f.cin);
   var ageOK = verifAge(f.age);
   

   if(pseudoOk && telOk && mailOk && mdpOk && cinOK && ageOK)

      return true;

   else

   {

    alert('Veuillez remplir correctement tous les champs');


      return false;

   }

}
function verifForm1(f)

{

   var numOk = verifCin1(f.num);

    var nomOk = verifNom(f.nom);
 

 if(numOk && nomOk)

      return true;

   else

   {

      alert('Veuillez remplir correctement tous les champs');

      return false;

   }

}
function verifForm5(f)

{

   var ageOk = verifAge(f.age1);

    var age1Ok = verifAge(f.age2);


 if(ageOk && age1Ok)

      return true;

   else

   {

      alert('Veuillez remplir correctement tous les champs');

      return false;

   }

}