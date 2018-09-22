public class HelloWorld {
    public void sayHello(String name,int year){
        System.out.println("Hello "+name+", your age is "+ DateUtil.calculateAge(year));
    }
}
