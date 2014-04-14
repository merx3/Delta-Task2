package delta.bg.training.tasks.scheduler;

public class Main {
	
	public static void main(String[] args){
		int i;
		for(i=0;i<7;i++){
			if(Scheduler.getWorkdays()[i]){
				Scheduler.arrangeHours(i);
				Scheduler.arrangeHours(i+7);
				Scheduler.addMoreHours(i);
				Scheduler.addMoreHours(i+7);
			}
		}
		Scheduler.rearrangeAveraging();
		Scheduler.dismissHours();
		for(Employee em : Scheduler.getEmployees()){
			em.writeEmployeeScheduleToFile("Employee" +em.getId() +".out");
		}
	}
}
