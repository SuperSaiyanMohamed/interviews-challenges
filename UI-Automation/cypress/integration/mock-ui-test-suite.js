describe("Mock UI Automation", () => {
    beforeEach(() => {
        cy.visit("/");
        cy.contains("a","Sign in").click();
    });
    xit("Testing with empty input in email address field", () =>{
        cy.get("#email_create").type("text");
        cy.get("#SubmitCreate").click();
        cy.contains("li","Invalid email address.");
    });
    xit("Testing with valid email address", () =>{
        cy.get("#email_create").type("mohamed@gmail.com");
        cy.get("#SubmitCreate").click();
        cy.url().should('include', '#account-creation');
    });
    xit("Leave register fields empty and click register", () =>{
        cy.get("#email_create").type("mohamed@gmail.com");
        cy.get("#SubmitCreate").click();
        cy.get("#submitAccount").click();
        cy.contains("p", "There are 8 errors");
    });
    xit("Add valid firstName only", () =>{
        cy.get("#email_create").type("mohamed@gmail.com");
        cy.get("#SubmitCreate").click();
        cy.get("#customer_firstname").type("Mohamed");
        cy.get("#submitAccount").click();
        cy.get("ol").should("not.have.text", "firstname");
    });
});