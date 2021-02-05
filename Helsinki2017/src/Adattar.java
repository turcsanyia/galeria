import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.TreeMap;

public class Adattar {

	public  static List<Versenyzo> rovidprogram = beolvas("rovidprogram.csv");
	public  static  List<Versenyzo> donto = beolvas("donto.csv");

	private static  List<Versenyzo> beolvas(String fajlNev) {
		List<Versenyzo> lista = new ArrayList<Versenyzo>();

		try {
			List<String> sorok = Files.readAllLines(Paths.get(fajlNev), StandardCharsets.UTF_8);
			for (String sor : sorok.subList(1, sorok.size())) {

				String[] adatok = sor.split(";");

				String nev = adatok[0];
				String orszag = adatok[1];
				double technikai = Double.parseDouble(adatok[2]);
				double komponens = Double.parseDouble(adatok[3]);
				double levonas = Double.parseDouble(adatok[4]);

				Versenyzo versenyzo = new Versenyzo(nev, orszag, technikai, komponens, levonas);
				lista.add(versenyzo);
			}

		} catch (IOException e) {
			e.printStackTrace();
			System.err.println();

		}

		return lista;
	}

	
	public int getVersenyzokSzama() {
		return rovidprogram.size();
	}

	public boolean bejutottEMagyarKurbe() {
		
		boolean bejutottEMagyar = false;

		for (Versenyzo versenyzo : donto) {
			if (versenyzo.getOrszag().equals("HUN")) {
				bejutottEMagyar = true;
				break;
			}
		}

		return bejutottEMagyar;
	}

	public boolean letezoVersenyzoE(String nev) {
		boolean letezikE = false;

		for (Versenyzo versenyzo : rovidprogram) {
			if (versenyzo.getNev().equals(nev)) {
				letezikE = true;
			}
		}

		return letezikE;
	}

	public double ÖsszPontszám(String nev) {
		double osszPontszam = 0;

		for (Versenyzo versenyzo : rovidprogram) {
			if (versenyzo.getNev().equals(nev)) {
				osszPontszam = versenyzo.ÖsszPontszám();
			}
		}

		for (Versenyzo versenyzo : donto) {
			if (versenyzo.getNev().equals(nev)) {
				osszPontszam += versenyzo.ÖsszPontszám();
			}
		}

		return osszPontszam;
	}

	private Map<String, Integer> getDontoStatisztika() {
		Map<String, Integer> statisztika = new TreeMap<String, Integer>();

		for (Versenyzo versenyzo : donto) {
			if (statisztika.containsKey(versenyzo.getOrszag())) {
				statisztika.merge(versenyzo.getOrszag(), 1, Integer::sum);
			} else {
				statisztika.put(versenyzo.getOrszag(), 1);
			}
		}

		return statisztika;
	}

	public String getStatisztika() {
		String tartalom = "";

		for (Map.Entry<String, Integer> pair : getDontoStatisztika().entrySet()) {
			if (pair.getValue() > 1) {
				tartalom += "\t" + pair.getKey() + ": " + pair.getValue() + " versenyző" + "\n";
			}
		}

		return tartalom;
	}

	public void FajlbaIras() throws IOException {
		String fajlba = "";
		
		int counter = 1;
		for (Versenyzo versenyzo : donto) {
			fajlba += counter + ";" + versenyzo.getNev() + ";" + versenyzo.getOrszag() + ";"
					+ ÖsszPontszám(versenyzo.getNev()) + "\n";
			counter++;
		}

		Files.write(Paths.get("vegeredmeny.csv"), fajlba.getBytes());
	}

}
