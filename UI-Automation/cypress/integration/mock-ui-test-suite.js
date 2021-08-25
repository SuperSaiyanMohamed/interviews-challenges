const UserData = require('../fixtures/users.json');
const RegistrationPage = require('../pageobjects/registrationPage.js');


describe("Mock UI Automation", () => {
    beforeEach(() => {
        RegistrationPage.pressSignInButton();
    });
    it("Testing with empty input in email address field", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit("text");
        RegistrationPage.checkListofErrors();
    });
    it("Testing with valid email address", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.checkUrlAccountCreate();
    });
    it("Leave register fields empty and click register", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.clickSubmitAccountButtonAndCheckError();
    });
    it("Add valid firstName only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingFirstName(UserData.user.firstname);
    });
    it("Add valid lastName only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingLastName(UserData.user.lastname);
    });
    it("Add valid password only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        cy.wait(2000);
        RegistrationPage.addingPassword(UserData.user.password);
    });
    it("Add valid Address only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingAddress(UserData.user.address);
    });
    it("Add valid city only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingCity(UserData.user.city);
    });
    it("Add valid State only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingState(UserData.user.state);
    });
    it("Add valid Zip Code only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingZipCode(UserData.user.zipcode);
    });
    it("Add valid mobile number only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingMobileNumber(UserData.user.mobilePhone)
    });
    it("Add valid alias address only", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingAliasAddress(UserData.user.aliasAddress);
    });
    it("Add valid info in all required fields", () =>{
        RegistrationPage.typeRegistrationEmailAndSubmit(UserData.user.email);
        RegistrationPage.addingFullInfo(UserData.user);
    });
});