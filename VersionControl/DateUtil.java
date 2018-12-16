import java.util.Date;
public class DateUtil {
    public static boolean checkDate(int day, int month, int year){
        boolean leapyear = false;
        if((day < 1) || (day > 31)) return false;
        if((month < 1) || (month > 12)) return false;
        if(year < 1) return false;
        if(year%4==0){
            leapyear = true;
            if((year%100==0) && (year%400!=0)) leapyear = false;
        }
        switch (month){
            case 2:
                if(leapyear){
                    if(day > 29) return false;
                    else return true;
                } else{
                    if(day > 28) return false;
                    else return true;
                }
            case 4:
            case 6:
            case 9:
            case 11:
                if(day == 31) return false;
                else return true;
            default: return true;
        }
    }
	public static int caculateAge(int year) {
		return (new Date().getYear() + 1900 - year);
	}
}
