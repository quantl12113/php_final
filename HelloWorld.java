public class HelloWorld {
	private String name;
    private int day;
    private int month;
    private int year;

	public HelloWorld() {
		while (true) {
			if (inputData())
				if (DateUtil.checkDate(day, month, year)) break;
		}
	}
}
