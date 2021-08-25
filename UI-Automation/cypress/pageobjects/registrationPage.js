class RegistrationPage{

    get signInButton () { return cy.contains("a","Sign in"); }
    get emailTextArea () { return cy.get("#email_create"); }
    get createAccountButton () { return cy.get("#SubmitCreate"); }
    get invalidEmailList () { return cy.contains("li","Invalid email address."); }
    get url () { return cy.url(); }
    get submitAccount () { return cy.get("#submitAccount"); }
    get paragraphError () { return cy.contains("p", "There are 8 errors"); }
    get listOfError () { return cy.get("ol"); }
    get customerFirstName () { return cy.get("#customer_firstname"); }
    get customerLastName () { return cy.get("#customer_lastname"); }
    get password () { return cy.get("#passwd"); }
    get customerAddress () { return cy.get("#address1"); }
    get customerCity () { return cy.get("#city"); }
    get customerState () { return cy.get("#id_state"); }
    get customerZipCode () { return cy.get("#postcode"); }
    get customerMobilePhone () { return cy.get("#phone_mobile"); }
    get customerAliasAddress () { return cy.get("#alias"); }

    pressSignInButton () {
        cy.visit("/");
        this.signInButton.click();
    }

    typeRegistrationEmailAndSubmit (email) {
        this.emailTextArea.type(email);
        this.createAccountButton.click();
    }

    checkListofErrors () {
        this.invalidEmailList;
    }

    checkUrlAccountCreate () {
        this.url.should('include', '#account-creation');
    }

    clickSubmitAccountButtonAndCheckError () {
        this.submitAccount.click();
        this.paragraphError;
    }

    addingFirstName (firstname) {
        this.customerFirstName.type(firstname);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "firstname");
    }

    addingLastName (lastname) {
        this.customerLastName.type(lastname);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "lastname");
    }

    addingPassword (password) {
        this.password.type(password);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "passwd");
    }

    addingAddress (address) {
        this.customerAddress.type(address);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "address1");
    }

    addingCity (city) {
        this.customerCity.type(city);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "city");
    }

    addingState (state) {
        this.customerState.select(state);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "State");
    }

    addingZipCode (zipcode) {
        this.customerZipCode.type(zipcode);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "Zip/Postal");
    }

    addingMobileNumber (mobileNumber) {
        this.customerMobilePhone.type(mobileNumber);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "phone number");
    }

    addingAliasAddress (aliasAddress) {
        this.customerAliasAddress.type(aliasAddress);
        this.submitAccount.click();
        this.listOfError.should("not.have.text", "alias");
    }

    addingFullInfo ({password, firstname, lastname, address, city, state, zipcode, mobilePhone, aliasAddress}) {
        this.customerFirstName.type(firstname);
        this.customerLastName.type(lastname);
        this.password.type(password);
        this.customerAddress.type(address);
        this.customerCity.type(city);
        this.customerState.select(state);
        this.customerZipCode.type(zipcode);
        this.customerMobilePhone.type(mobilePhone);
        this.customerAliasAddress.type(aliasAddress);
        this.submitAccount.click();
        this.url.should('include', 'controller=my-account');
    }
}

module.exports = new RegistrationPage();