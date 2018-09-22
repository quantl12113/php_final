import java.util.Date;
public class DateUtil {
	public static int caculateAge(int year) {
		return (new Date().getYear() + 1900 - year);
	}
}
