public class Customer {
    private int id;
    private string status;
    private string username;
    private string password;
    private string address;
    private string name;
    private string phone_number;
    private string[] list_order;
    private string[] list_payment;
    
    //......		

    public void Login(string password) {
        if (this.password = System.encode(password, "SHA256")) {
	       this.status = "Online";
	   } else {
	       System.out.println("Wrong password);
	   }
    }

    public void Logout() {
         this.status = "Offline";
    }

}
